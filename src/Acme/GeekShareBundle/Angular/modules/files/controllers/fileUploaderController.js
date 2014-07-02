/* 
 * IndexController from errorPage Module
 */

app.registerController(function() {
    var self = this;

    self.moduleName = "files";
    self.controllerName = "fileUploaderController";


    self.initController = function() {
        angular.module(self.moduleName).controller([self.moduleName, self.controllerName].join("."), ['$scope', '$upload', '$stateParams',
            function($scope, $upload, $stateParams) {

                $scope.show = function() {
                    $scope.elementClasses = "active";
                };

                $scope.$on('files.showUploader', function(event) {
                    $scope.show();
                });


                $scope.filesList = [];
                $scope.fileSelected = function($files) {
                    var directory = $stateParams.directory;
                    console.log(directory);
                    for (var i = 0; i < $files.length; i++) {
                        var file = $files[i];
                        $scope.filesList.push(file);
                        file.finished = false;
                        file.percent = 0;
                        file.upload = $upload.upload({
                            url: app.api.url("files", "upload"),
                            data: {
                                directory: directory,
                                name : file.name
                            },
                            file: file
                        }).progress(function(evt) {
                            file.percent = parseInt(100.0 * evt.loaded / evt.total);
                            file.progressStyle = {
                                "width": file.percent + "%"
                            };
                            file.message = file.percent+'%';
                            file.itemClass = "uploading";

                        }).success(function(data, status, headers, config) {
                            file.itemClass = "finished";
                            file.message = "Uploaded to "+directory+" directory";
                        }).error(function(response, errorCode, errorMessage) {
                            file.itemClass = "error";
                            file.message = "Unable to upload this file to server. Please try again"
                        });
                        
                        file.abort = function(){
                            file.itemClass = "abort";
                            file.upload.abort();
                            
                        };
                    }
                    
                };


                $scope.hide = function() {
                    $scope.elementClasses = "hidden";
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