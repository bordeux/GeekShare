/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "user";
    self.controllerName = "authResetPasswordController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$state', 'user.$userService',
          function ($scope, $state, $userService) {
                $scope.resetPassword = function() {
                    $scope.errorMessage = "";
                        var result = $userService.login($scope.login).$promise.then(function(user) {
                        $state.go("files");
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
        controllerName : self.controllerName,
        bootstrap: function() {
            self.initController();
        }
    };
});