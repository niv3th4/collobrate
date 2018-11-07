angular.module 'Pyoopil.Controllers'
.controller 'logoutCtrl', ['$scope', 'Auth', '$state', ($scope, Auth, $state)->

  Auth.logout()

]