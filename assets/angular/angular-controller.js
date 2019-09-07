/* controller */
var BASE_URL = "http://localhost/labs/socologin/";
var ADMIN_ID = 1;
// var BASE_URL = "http://savezindagi.com/socologin/";

socApp.controller('appMainCtrl', function($scope, $http, $window) {
    $scope.app_session =[];

    $scope.goTo = function (src,feature=null) {
        if(feature){
            if(!$scope.accessError(feature)){
                return false;
            }
        }
        $window.location.href = BASE_URL+src;
    }

    $scope.goToBack = function (src) {
        $window.history.back();
    }

    $scope.getRowData = function (val, data = null) {
		if (data != null) {
			var queryStr = BASE_URL + 'dashboard/get_row_data?param1=' + val + '&param2=' + data;
		} else {
			var queryStr = BASE_URL + 'dashboard/get_row_data?param1=' + val;
		}

		$http.get(queryStr)
			.then(function (response) {
				$scope.select_row_data = response.data.data;
			});
    }


    $scope.getSessionData = function () {
        $http({
            method: 'GET',
            url: BASE_URL+'dashboard/get_session',
        })
        .then(function (response) {
            $scope.app_session.logged_data = response.data.data;
            $scope.app_session.package_data = response.data.package_data;
            $scope.app_session.team_data = response.data.team_data;
        });
    }

    $scope.checkAll = function () {
		checkAllStatus();
	}

	$scope.checkCustom = function () {
		checkCustomStatus();
    }

    function findElement(arr, propName, propValue) {
        if(arr.length==1){
            return true;
        }
        for (var i=0; i < arr.length; i++)
          if (arr[i][propName] == propValue)
            return arr[i];
        // will return undefined if not found; you could return a default instead
      }

    /* Team management Code */
        $scope.accessError = function(feature){
            if($scope.packageError(feature)){
                if($scope.teamError(feature)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        $scope.teamError = function(feature){
                var t_data = [];
                t_data[0] = $scope.app_session.team_data;
                var x = findElement(t_data, feature, 1);
                if(x==undefined){
                    $('#app-teamError-box .main-btn').off('click');
                    $('#app-teamError-box').modal('show');
                    return false;
                }else{
                    return true;
                }
        }

        $scope.packageError = function(feature){
                if($scope.app_session.logged_data['parent_id']==ADMIN_ID){
                    return true;
                }
                var p_data = [];
                p_data[0] = $scope.app_session.package_data;
                var x = findElement(p_data, feature, 1);
                if(x==undefined){
                    $('#app-packageError-box .main-btn').off('click');
                    $('#app-packageError-box').modal('show');
                    return false;
                }else{
                    return true;
                }
        }
    /* Team management Code */



    $scope.getSessionData();
});


socApp.controller('dashboardCtrl', function($scope, $http, $window) {

});

socApp.controller('appMembersCtrl', function($scope, $http, $window,$timeout) {
    $scope.options = '';
	$scope.currentPage = 1;
	$scope.searchBy = '';
	$scope.pageBy = '10';
	$scope.orderBy = 'created_at';
	$scope.filterBy = 'all';
	$scope.orderType = 'desc';
	$scope.start_date = '';
    $scope.end_date = '';
    $scope.member = [];

    var current_member_id = $('#param1').val();
    if(current_member_id){
        var filter_data = {
            member_id: zingoCrypt(current_member_id,'d'),
        };
        $scope.getRowData('member', JSON.stringify(filter_data));
        $timeout(function () {
            $scope.member = {
                emailBy:$scope.select_row_data.email,
                passwordBy:$scope.select_row_data.password,
                roleBy:$scope.select_row_data.role_id,
                nameBy:$scope.select_row_data.name
            };
        },200);

    }

	// For Page Change Code
	$scope.$watch("currentPage", function () {
		$scope.getData();
    });

    // For Sort by Code
    $scope.sortData = function (param) {
		$scope.orderBy = param;
		$scope.orderType = ($scope.orderType == 'asc') ? 'desc' : 'asc';
		$scope.getData();
    }

	$scope.getData = function () {
        var filter_date_data = get_filter_date_option($scope.filterBy);
        $scope.start_date = filter_date_data['start_date'];
        $scope.end_date = filter_date_data['end_date'];
		$scope.options = '&search_key=' + $scope.searchBy + '&items_per_page=' + $scope.pageBy + '&date_start=' + $scope.start_date + '&date_end=' + $scope.end_date + '&order_by=' + $scope.orderBy + '&order_type=' + $scope.orderType + '&filter_key=' + $scope.filterBy;
		$scope.current_page = $scope.currentPage - 1;
		$http({
				method: 'GET',
				url: BASE_URL + 'member/list?current_page=' + $scope.current_page + $scope.options
			})
			.then(function (response) {
				// $scope.filterCounts('list');
				// $scope.exportOptionsClose(0);
				// response.data.data = appendChecked(response.data.data);
				$scope.results = response.data.data;
				$scope.total_rows = response.data.total_rows;
				$scope.total_lists = response.data.total_lists;
				$scope.numPages = Math.ceil($scope.total_rows / $scope.pageBy);
				$scope.end = $scope.currentPage * $scope.pageBy;
                $scope.end = ($scope.end > $scope.total_rows) ? $scope.total_rows : $scope.end;
                $scope.getRoles();
			});
    }

    $scope.getRoles = function () {
       	$http({
				method: 'GET',
				url: BASE_URL + 'member/role_list'
			})
			.then(function (response) {
				$scope.app_roles = response.data.data;
			});
    }

	$scope.getData();

    $scope.deleteMembers = function (id) {
        if(!$scope.accessError('delete_member')){
            return false;
        }
        $('#app-delete-box .main-btn').off('click');
        $('#app-delete-box').modal('show');
        $('#app-delete-box .main-btn').on('click', function (e) {
            if (id) {
                var selected = [];
                selected.push(id);
            } else {
                var selected = [];
                var selected = $('.check-account:checked').map(function () {
                    return $(this).val();
                }).get();
            }
            var formData = $.param({
                id: selected,
            });
            $http({
                    method: 'POST',
                    url: 'member/delete',
                    data: formData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
                    console.log(response.data.message)
                    $('#app-delete-box').modal('hide');
                    toastShow(response.data.message, response.data.status);
                    if (response.data.status == "success") {
                        $scope.getData();
                        refresh_lists();
                    }
                });
        });

    }

    $scope.goToAddMember = function () {
        $window.location.href = BASE_URL+"member/add";
    }

    $scope.goToEditMember = function (id) {
        if(!$scope.accessError('edit_member')){
            return false;
        }
        $window.location.href = BASE_URL+"member/edit/"+zingoCrypt(id);
    }

    $scope.addMember = function () {
        var formData = $.param({
            email: $scope.member.emailBy,
            password: $scope.member.passwordBy,
            name: $scope.member.nameBy,
            role: $scope.member.roleBy,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'member/add',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                console.log(response);
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"members";
                }
            });
    }

    $scope.saveMember = function () {
        var current_member_id = $('#param1').val();
        var formData = $.param({
            member_id: zingoCrypt(current_member_id,'d'),
            email: $scope.member.emailBy,
            name: $scope.member.nameBy,
            role: $scope.member.roleBy,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'member/edit',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"members";
                }
            });
    }

    $scope.statusMember = function (id,status) {
        var status = (status == 1) ? 0 : 1;
		var formData = $.param({
			id: id,
			status: status
		});
        $http({
                method: 'POST',
                url: BASE_URL+'member/status',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $scope.getData();
                    refresh_lists();
                }
            });
    }

    $scope.viewMember = function (id) {
        $('#app-member-view-box').modal('show');
        $('#app-member-view-box #memberName').html($scope.results[id].name);
        $('#app-member-view-box #memberRole').html($scope.results[id].role_title);
        $('#app-member-view-box #memberEmail').html($scope.results[id].email);
        $('#app-member-view-box #memberCreated').html($scope.results[id].created_at);
    }


});

socApp.controller('appRolesCtrl', function($scope, $http, $window,$timeout) {
    $scope.options = '';
	$scope.currentPage = 1;
	$scope.searchBy = '';
	$scope.pageBy = '10';
	$scope.orderBy = 'created_at';
	$scope.filterBy = 'all';
	$scope.orderType = 'desc';
	$scope.start_date = '';
    $scope.end_date = '';
    $scope.role = [];

    var current_role_id = $('#param2').val();
    if(current_role_id){
        var filter_data = {
            role_id: zingoCrypt(current_role_id,'d'),
        };
        $scope.getRowData('role', JSON.stringify(filter_data));

        $timeout(function () {
            $scope.role = {
                title:$scope.select_row_data.title,
                features:JSON.parse($scope.select_row_data.role_features),
            };
        },200);
    }


	// For Page Change Code
	$scope.$watch("currentPage", function () {
		$scope.getData();
    });

    // For Sort by Code
    $scope.sortData = function (param) {
		$scope.orderBy = param;
		$scope.orderType = ($scope.orderType == 'asc') ? 'desc' : 'asc';
		$scope.getData();
    }

	$scope.getData = function () {
        var filter_date_data = get_filter_date_option($scope.filterBy);
        $scope.start_date = filter_date_data['start_date'];
        $scope.end_date = filter_date_data['end_date'];
		$scope.options = '&search_key=' + $scope.searchBy + '&items_per_page=' + $scope.pageBy + '&date_start=' + $scope.start_date + '&date_end=' + $scope.end_date + '&order_by=' + $scope.orderBy + '&order_type=' + $scope.orderType + '&filter_key=' + $scope.filterBy;
		$scope.current_page = $scope.currentPage - 1;
		$http({
				method: 'GET',
				url: 'role_list?current_page=' + $scope.current_page + $scope.options
			})
			.then(function (response) {
				$scope.results = response.data.data;
				$scope.total_rows = response.data.total_rows;
				$scope.total_lists = response.data.total_lists;
				$scope.numPages = Math.ceil($scope.total_rows / $scope.pageBy);
				$scope.end = $scope.currentPage * $scope.pageBy;
				$scope.end = ($scope.end > $scope.total_rows) ? $scope.total_rows : $scope.end;
			});
    }

	$scope.getData();

    $scope.deleteRoles = function (id) {
        $('#app-delete-box .main-btn').off('click');
        $('#app-delete-box').modal('show');
        $('#app-delete-box .main-btn').on('click', function (e) {
            if (id) {
                var selected = [];
                selected.push(id);
            } else {
                var selected = [];
                var selected = $('.check-account:checked').map(function () {
                    return $(this).val();
                }).get();
            }
            var formData = $.param({
                id: selected,
            });
            $http({
                    method: 'POST',
                    url: BASE_URL+'member/role_delete',
                    data: formData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
                    $('#app-delete-box').modal('hide');
                    toastShow(response.data.message, response.data.status);
                    if (response.data.status == "success") {
                        $scope.getData();
                        refresh_lists();
                    }
                });
        });

    }

    $scope.goToAddRole = function () {
        $window.location.href = BASE_URL+"member/add";
    }

    $scope.goToEditRole = function (id) {
        $window.location.href = BASE_URL+"member/role/edit/"+zingoCrypt(id);
    }



    $scope.addRole = function () {
        var formData = $.param({
            title: $scope.role.title,
            features_data: $scope.role.features,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'member/role/add',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"member/roles";
                }
            });
    }

    $scope.saveRole = function () {
        var current_role_id = $('#param2').val();
        var formData = $.param({
            role_id: zingoCrypt(current_role_id,'d'),
            title: $scope.role.title,
            features_data: $scope.role.features,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'member/role/edit',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"member/roles";
                }
            });
    }


});

socApp.controller('appPackagesCtrl', function($scope, $http, $window,$timeout) {
    $scope.options = '';
	$scope.currentPage = 1;
	$scope.searchBy = '';
	$scope.pageBy = '10';
	$scope.orderBy = 'created_at';
	$scope.filterBy = 'all';
	$scope.orderType = 'desc';
	$scope.start_date = '';
    $scope.end_date = '';
    $scope.package = [];

    var current_package_id = $('#param3').val();
    if(current_package_id){
        var filter_data = {
            package_id: zingoCrypt(current_package_id,'d'),
        };
        $scope.getRowData('package', JSON.stringify(filter_data));

        $timeout(function () {
            $scope.package = {
                package_price:$scope.select_row_data.package_price,
                package_name:$scope.select_row_data.package_name,
                package_description:$scope.select_row_data.package_description,
                features:JSON.parse($scope.select_row_data.package_data),
            };
        },200);
    }


	// For Page Change Code
	$scope.$watch("currentPage", function () {
		$scope.getData();
    });

    // For Sort by Code
    $scope.sortData = function (param) {
		$scope.orderBy = param;
		$scope.orderType = ($scope.orderType == 'asc') ? 'desc' : 'asc';
		$scope.getData();
    }

	$scope.getData = function () {
        var filter_date_data = get_filter_date_option($scope.filterBy);
        $scope.start_date = filter_date_data['start_date'];
        $scope.end_date = filter_date_data['end_date'];
		$scope.options = '&search_key=' + $scope.searchBy + '&items_per_page=' + $scope.pageBy + '&date_start=' + $scope.start_date + '&date_end=' + $scope.end_date + '&order_by=' + $scope.orderBy + '&order_type=' + $scope.orderType + '&filter_key=' + $scope.filterBy;
		$scope.current_page = $scope.currentPage - 1;
		$http({
				method: 'GET',
				url: 'package?current_page=' + $scope.current_page + $scope.options
			})
			.then(function (response) {
				$scope.results = response.data.data;
				$scope.total_rows = response.data.total_rows;
				$scope.total_lists = response.data.total_lists;
				$scope.numPages = Math.ceil($scope.total_rows / $scope.pageBy);
				$scope.end = $scope.currentPage * $scope.pageBy;
				$scope.end = ($scope.end > $scope.total_rows) ? $scope.total_rows : $scope.end;
			});
    }

	$scope.getData();

    $scope.deletePackages = function (id) {
        $scope.accessError('delete_package');
        $('#app-delete-box .main-btn').off('click');
        $('#app-delete-box').modal('show');
        $('#app-delete-box .main-btn').on('click', function (e) {
            if (id) {
                var selected = [];
                selected.push(id);
            } else {
                var selected = [];
                var selected = $('.check-account:checked').map(function () {
                    return $(this).val();
                }).get();
            }
            var formData = $.param({
                id: selected,
            });
            $http({
                    method: 'POST',
                    url: BASE_URL+'package/package_delete',
                    data: formData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
                    $('#app-delete-box').modal('hide');
                    toastShow(response.data.message, response.data.status);
                    if (response.data.status == "success") {
                        $scope.getData();
                        refresh_lists();
                    }
                });
        });

    }

    $scope.goToAddPackage = function () {
        $window.location.href = BASE_URL+"packages/add";
    }

    $scope.goToEditPackage = function (id) {
        $window.location.href = BASE_URL+"packages/edit/"+zingoCrypt(id);
    }



    $scope.addPackage = function () {
        var formData = $.param({
            title: $scope.package.package_name,
            price: $scope.package.package_price,
            description: $scope.package.package_description,
            features_data: $scope.package.features,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'packages/add',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"packages";
                }
            });
    }

    $scope.savePackage = function () {
        var current_package_id = $('#param3').val();
        var formData = $.param({
            package_id: zingoCrypt(current_package_id,'d'),
            title: $scope.package.package_name,
            price: $scope.package.package_price,
            description: $scope.package.package_description,
            features_data: $scope.package.features,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'packages/edit',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"packages";
                }
            });
    }

});

socApp.controller('appPageCtrl', function($scope, $http, $window,$timeout) {
    $scope.options = '';
	$scope.currentPage = 1;
	$scope.searchBy = '';
	$scope.pageBy = '10';
	$scope.orderBy = 'created_at';
	$scope.filterBy = 'all';
	$scope.orderType = 'desc';
	$scope.start_date = '';
    $scope.end_date = '';
    $scope.page = [];
    $scope.page.pages = [{id: 'w1', name: 'page 1',slug: 'page-1'},];

	$scope.addRow = function() {
     var newItemNo = $scope.page.pages.length+1;
     $scope.page.pages.push({'id' : 'w' + newItemNo, 'name' : 'page ' + newItemNo, 'slug' : 'page-' + newItemNo});
   };
   
   $scope.removeRow = function(id) {
    $scope.page.pages.splice(id, 1);
   };
   
   $scope.showRow = function(item) {
     return item.id === $scope.page.pages[$scope.page.pages.length-1].id;
   };



    var current_page_id = $('#param4').val();
    if(current_page_id){
        var filter_data = {
            page_id: zingoCrypt(current_page_id,'d'),
        };
        $scope.getRowData('page', JSON.stringify(filter_data));

        $timeout(function () {
            $scope.page = {
                page_name:$scope.select_row_data.page_name,
                page_description:$scope.select_row_data.page_description,
                pages:JSON.parse($scope.select_row_data.page_data),
            };
        },200);
    }


	// For Page Change Code
	$scope.$watch("currentPage", function () {
		$scope.getData();
    });

    // For Sort by Code
    $scope.sortData = function (param) {
		$scope.orderBy = param;
		$scope.orderType = ($scope.orderType == 'asc') ? 'desc' : 'asc';
		$scope.getData();
    }

	$scope.getData = function () {
        var filter_date_data = get_filter_date_option($scope.filterBy);
        $scope.start_date = filter_date_data['start_date'];
        $scope.end_date = filter_date_data['end_date'];
		$scope.options = '&search_key=' + $scope.searchBy + '&items_per_page=' + $scope.pageBy + '&date_start=' + $scope.start_date + '&date_end=' + $scope.end_date + '&order_by=' + $scope.orderBy + '&order_type=' + $scope.orderType + '&filter_key=' + $scope.filterBy;
		$scope.current_page = $scope.currentPage - 1;
		$http({
				method: 'GET',
				url: 'page?current_page=' + $scope.current_page + $scope.options
			})
			.then(function (response) {
				$scope.results = response.data.data;
				$scope.total_rows = response.data.total_rows;
				$scope.total_lists = response.data.total_lists;
				$scope.numPages = Math.ceil($scope.total_rows / $scope.pageBy);
				$scope.end = $scope.currentPage * $scope.pageBy;
				$scope.end = ($scope.end > $scope.total_rows) ? $scope.total_rows : $scope.end;
			});
    }

	$scope.getData();

    $scope.deletePages = function (id) {
        if(!$scope.accessError('delete_page')){
            return false;
        }
        $('#app-delete-box .main-btn').off('click');
        $('#app-delete-box').modal('show');
        $('#app-delete-box .main-btn').on('click', function (e) {
            if (id) {
                var selected = [];
                selected.push(id);
            } else {
                var selected = [];
                var selected = $('.check-account:checked').map(function () {
                    return $(this).val();
                }).get();
            }
            var formData = $.param({
                id: selected,
            });
            $http({
                    method: 'POST',
                    url: BASE_URL+'page/page_delete',
                    data: formData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function (response) {
                    $('#app-delete-box').modal('hide');
                    toastShow(response.data.message, response.data.status);
                    if (response.data.status == "success") {
                        $scope.getData();
                        refresh_lists();
                    }
                });
        });

    }

    $scope.goToAddPage = function () {
        $window.location.href = BASE_URL+"pages/add";
    }

    $scope.goToEditPage = function (id) {
        $window.location.href = BASE_URL+"pages/edit/"+zingoCrypt(id);
    }



    $scope.addPage = function () {
        var formData = $.param({
            title: $scope.page.page_name,
            description: $scope.page.page_description,
            page_data: $scope.page.pages,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'pages/add',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"pages";
                }
            });
    }

    $scope.savePage = function () {
        var current_page_id = $('#param4').val();
        var formData = $.param({
            page_id: zingoCrypt(current_page_id,'d'),
            title: $scope.page.page_name,
            description: $scope.page.page_description,
            page_data: $scope.page.pages,
        });
        $http({
                method: 'POST',
                url: BASE_URL+'pages/edit',
                data: formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            })
            .then(function (response) {
                toastShow(response.data.alert_data.message, response.data.alert_data.status);
                if (response.data.alert_data.status == "success") {
                    $window.location.href = BASE_URL+"pages";
                }
            });
    }

});

