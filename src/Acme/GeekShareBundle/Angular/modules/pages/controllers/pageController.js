/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "pages";
    self.controllerName = "pageController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', 'page',
          function ($scope, page) {
   
              $scope.page = page;
              $scope.content = page.content;
              
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