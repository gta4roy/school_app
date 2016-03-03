var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("school_app/api/test_medo.php")
   .then(function (response) {$scope.names = response.data.records;});
});

var  create_user_app= angular.module('signup_app',[]);
create_user_app.controller('signup_ctrl',function($scope, $http) {

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
					$scope.error_msg = data.message;
				}	

			});
	      }
});


