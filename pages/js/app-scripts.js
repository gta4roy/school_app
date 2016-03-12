//var app = angular.module('myApp', []);
//app.controller('customersCtrl', function ($scope, $http) {
//   $http.get("school_app/api/test_medo.php")
//   .then(function (response) {$scope.names = response.data.records; });
//});

var  create_user_app= angular.module('signup_app', ['ngRoute']);
create_user_app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/signUp', {
        templateUrl: 'signup_view.html',
        controller: 'signup_ctrl'
    }).
      when('/Login', {
        templateUrl: 'login_view.html',
        controller: 'login_ctrl'
      }).
       when('/main', {
        templateUrl: 'main_page_view.html',
        controller: 'main_ctrl'
      }).
      otherwise({
        redirectTo: '/signUp'
      });
}]);
create_user_app.controller('signup_ctrl',function($scope, $http,$location) {

		$scope.signup_submit_data = function() 
		{

			$http({
				method: "post",
				url: "js/school_app/api/signup.php",
				data: {
					email     : $scope.email,
					pass	  : $scope.pass,
					username : $scope.username,
					city      : $scope.city,
					role      : $scope.role
					
				},
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

			}).success(function(data,status,header,config){

			
				if(parseInt(data.ret) === 0){

					$scope.error_msg = data.error;
				}else{
					
				//	$scope.error_msg = $location.path();
					$location.path("/Login");
				
				}	

			});
			
	      }
}).$inject = ['$location'];

create_user_app.controller('login_ctrl',function($scope, $http,$location) {

		$scope.signup_submit_data = function() 
		{

			$http({
				method: "post",
				url: "js/school_app/api/signup.php",
				data: {
					email     : $scope.email,
					pass	  : $scope.pass,
					username : $scope.username,
					city      : $scope.city,
					role      : $scope.role
					
				},
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

			}).success(function(data,status,header,config){

			
				if(parseInt(data.ret) === 0){

					$scope.error_msg = data.error;
				}else{
					
				//	$scope.error_msg = $location.path();
					$location.path("/Login");
				
				}	

			});
			
	      }
}).$inject = ['$location'];

create_user_app.controller('main_ctrl',function($scope, $http,$location) {

	
}).$inject = ['$location'];

