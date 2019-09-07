/* directives */
var testcount = 0;
socApp.directive("getTemplate", function() {
    return {
        restrict: "E",
        scope: !0,
        templateUrl: function(elem, attrs) {
            // console.log(cdnUrl + attrs.item);
            return cdnUrl + attrs.item;
        }
    }
});
socApp.directive("getScopeTemplate", function() {
    return {
        restrict: 'E',
        scope: {
            path: '@'
        },
        template: '<ng-include src="path"></ng-include>'
    };
});
socApp.directive("warningDelete", function() {
    return {
        restrict: "E",
        templateUrl: cdnUrl + "warning-delete.html"
    }
});

socApp.directive('overlay', function() {
    return {
        restrict: 'E',
        template: '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>'
    }
});