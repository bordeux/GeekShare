/* 
 * Index page
 */

app.registerModule(function() {
    var self = this;

    self.moduleName = "pages";



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
                        .state('page', {
                            url: "/page/:name",
                            templateUrl: app.assets.template(self.moduleName, "page.html"),
                            controller : "pages.pageController",
                            resolve: {
                                page : ["$stateParams", "pages.$pagesService", function($stateParams, $pagesService) {                                       
                                        return $pagesService.get($stateParams).$promise;
                                    }]
                            }
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