var app = angular.module('MyApp',['ngRoute']);

app.config(['$routeProvider',function($routeProvider,$routeParams){
    $routeProvider.when('/timeline/:id',{
       templateUrl : function(params){ return 'content/doggo_timeline.php?id='+params.id;},
       controller : 'DogController'
    })
    .when('/dogs',{
        templateUrl : 'content/dogs.php',
        controller : 'DogController'
    })
    .when('/updates',{
        templateUrl : 'content/updates.php',
        controller : 'UpdateController'
    })
    .when('/people',{
        templateUrl : 'content/people.php',
        controller : 'PeopleController'
    })
    .when('/profile/:id',{
        templateUrl : function(params){ return 'content/profile.php?id=' + params.id; },
        controller : 'PeopleController'
    });
}]);