/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "files";
    self.controllerName = "fileListController";
    
    
    self.initController = function(){
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$state', 'filesList', 'files.$filesService', '$stateParams', '$rootScope',
          function ($scope, $state, filesList, $filesService, $stateParams, $rootScope) {
   
              $scope.filesList = filesList;
              
              var pathExploted = filesList.currentPath.split("→");
              var pathUrl = "";
              
              
              $rootScope.currentPath = [];
              for(var i in pathExploted){
                  var name = pathExploted[i];
                  pathUrl += name;
                  $rootScope.currentPath.push({
                      label : name,
                      fullPath :pathUrl
                  });
                  
                  pathUrl += "→";
              }
              
              $rootScope.openDirectory = function(fullPath){
                  $state.go("files.list", {directory: fullPath});
              };
           
              
              
              $scope.openDir = function(dir){
                  $rootScope.openDirectory(dir.fullPath);
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
              
              $rootScope.totalSize = function(){
                  var size = 0;
                  for(var i in filesList.files){
                      size += filesList.files[i].size;
                  }
                  return size;
              };
              
              $scope.showUploader = function(){
                  $scope.$emit('files.showUploader');
              };
              
              $scope.deleteDir = function(dir){
                  if(!confirm("Do you realy want delete "+dir.name+" dir?")){
                      return;
                  }
                  
                  $filesService.delete({
                     dir :  dir.id
                  }).$promise.then(function(){
                      $state.go('files.list', $stateParams, {reload : true });
                  }, function(){
                      alert("Unable to delete dir");
                  });
                  
              };
              
              $scope.deleteFile = function(file){
                  if(!confirm("Do you realy want delete "+file.name+" dir?")){
                      return;
                  }
                  
                  $filesService.delete({
                     file :  file.id
                  }).$promise.then(function(){
                      $state.go('files.list', $stateParams, {reload : true });
                  }, function(){
                      alert("Unable to delete file");
                  });
                  
              };
              
              $scope.shareFile = function(file){
                  prompt("Copy this link to share", file.downloadLink);
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