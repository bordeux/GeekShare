/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "user";
    self.controllerName = "authRegisterController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$state', 'user.$userService',
          function ($scope, $state, $userService) {
             
              $scope.registerUser = function(){
                  alert("Test");
                  alert($userService);
                  
                  console.log($scope.register);
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