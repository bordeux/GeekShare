/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "files";
    self.controllerName = "fileListController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$state',
          function ($scope, $state) {
              $scope.files = [
                  {name: Math.random(), size:"10mb", link : Math.random()},
                  {name: Math.random(), size:"10mb", link : Math.random()},
                  {name: Math.random(), size:"10mb", link : Math.random()},
                  {name: Math.random(), size:"10mb", link : Math.random()},
      
              ];
              
              $scope.openDir = function(file){
                  $state.go("files.list", {directory: file.link});
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