/* 
 * IndexController from errorPage Module
 */
app.registerDirective(function() {
    var self = this;

    self.moduleName = "files";
    self.directiveName = "filesUploader";
    
    self.initDirective = function(){
        angular.module(self.moduleName).directive(self.directiveName, function() {
            return {
              restrict: 'E',
              replace: true,
              transclude: true,
              templateUrl: app.assets.template(self.moduleName, "filesUploaderDirective.html")
            };
        });
    };
  
  
    /**
     * Return config
     */
    return {
        name: self.moduleName,
        directiveName : self.directiveName,
        bootstrap: function() {
            self.initDirective();
        }
    };
});