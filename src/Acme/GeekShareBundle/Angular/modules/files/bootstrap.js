/* 
 * Index page
 */

app.registerModule(function() {
    var self = this;

    self.moduleName = "files";



    self.initModule = function() {
        angular.module(self.moduleName, ['ui.router']);
    };

    /**
     * 
     * @returns {void}
     */
    self.registerRoutes = function() {
        angular.module(self.moduleName).config(['$stateProvider',
            function($stateProvider) {
                $stateProvider
                        .state('files', {
                            url: "/files",
                            templateUrl: app.assets.template(self.moduleName, "files.html")
                        })
                        .state('files.list', {
                            url: "/:directory",
                            templateUrl: app.assets.template(self.moduleName, "filesList.html")
                        });


            }]);

    };

    /**
     * Return config
     */
    return {
        name: self.moduleName,
        appRequires: [
            self.moduleName
        ],
        bootstrap: function() {
            self.initModule();
            self.registerRoutes();
        }
    };
});