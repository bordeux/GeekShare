/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "user";
    self.controllerName = "settingsController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', 'user',
          function ($scope, user) {
              $scope.user = user;
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