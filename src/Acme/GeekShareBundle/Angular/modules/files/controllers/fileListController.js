/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "files";
    self.controllerName = "fileListController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$state', 'filesList', 'files.$filesService', '$stateParams',
          function ($scope, $state, filesList, $filesService, $stateParams) {
   
              $scope.filesList = filesList;
              
              $scope.openDir = function(dir){
                  $state.go("files.list", {directory: dir.fullPath});
              };
              
              $scope.createDir = function(){
                  var dirName = prompt("Enter new dir name");
                  var re = /^[^/\\→]+$/; 
                  if(dirName.length < 3 || !re.test(dirName)){
                      alert("Invalid dir name");
                      return;
                  };
                  $filesService.create({
                     directory :  filesList.currentPath,
                     name : dirName
                  }).$promise.then(function(){
                      $state.go('files.list', $stateParams, {reload : true });
                  }, function(){
                      alert("Unable to add new dir");
                  });
                  
              };
              
              $scope.deleteDir = function(dir){
                  if(!confirm("Do you realy want delete "+dir.name+" dir?")){
                      return;
                  }
                  
                  $filesService.delete({
                     directory :  dir.fullPath
                  }).$promise.then(function(){
                      $state.go('files.list', $stateParams, {reload : true });
                  }, function(){
                      alert("Unable to delete dir");
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