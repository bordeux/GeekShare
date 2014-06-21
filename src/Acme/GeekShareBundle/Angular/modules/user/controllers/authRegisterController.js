/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "user";
    self.controllerName = "authRegisterController";


    self.initController = function() {
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$state', 'user.$userService',
            function($scope, $state, $userService) {

                $scope.registerUser = function() {
                    $scope.errorMessage = "";
                    var result = $userService.create($scope.register).$promise.then(function(user) {
                        $state.go("files.list", {directory: "root"});
                    }, function(error) {
                        
                        $scope.errorMessage = error.data.message;
                    });

                };

            }]);
    };


    /**
     * Return config
     */
    return {
        name: self.moduleName,
        controllerName: self.controllerName,
        bootstrap: function() {
            self.initController();
        }
    };
});