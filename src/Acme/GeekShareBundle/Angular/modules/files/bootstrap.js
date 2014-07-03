/* 
 * Index page
 */

app.registerModule(function() {
    var self = this;

    self.moduleName = "files";



    self.initModule = function() {
        angular.module(self.moduleName, ['ui.router', 'angularFileUpload']);
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
                            templateUrl: app.assets.template(self.moduleName, "files.html"),
                            /*controller: ["$state", function($state) {
                             if ($state.current.name = "files") {
                             //$state.go("files.list", {directory: "root"});
                             }
                             
                             }]*/
                        })
                        .state('files.list', {
                            url: "/:directory",
                            templateUrl: app.assets.template(self.moduleName, "filesList.html"),
                            controller: "files.fileListController",
                            resolve: {
                                user: ["user.$userService", function($userService) {
                                        return $userService.get().$promise;
                                    }],
                                filesList: ["$stateParams", "files.$filesService", function($stateParams, $filesService) {
                                        return $filesService.list($stateParams).$promise;
                                    }]
                            }
                        });





            }]);

    };


    self.registerFilters = function() {
        angular.module(self.moduleName).filter('bytes', function() {
            return function(bytes, precision) {
                if(!bytes){
                    return "-";
                }
                if (isNaN(parseFloat(bytes)) || !isFinite(bytes))
                    return '-';
                if (typeof precision === 'undefined')
                    precision = 1;
                var units = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB'],
                        number = Math.floor(Math.log(bytes) / Math.log(1024));
                return (bytes / Math.pow(1024, Math.floor(number))).toFixed(precision) + ' ' + units[number];
            }
        });
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
            self.registerFilters();
        }
    };
});