angular.module 'Pyoopil.Services'
.factory 'UserService', ['$window', 'Form', 'CRUD', '$cookieStore', '$q', 'Auth',
  ($window, Form, CRUD, $cookieStore, $q, Auth)->

    new class UserService

      constructor : ->

      init : (scope)->
        @scope = scope


      login : (data, callback) =>

        cb = callback || angular.noop
        deferred = $q.defer()

        promise = Form.postData(data, CRUD.LOGIN)

        promise.then(
          (data)=>
            if data.data.status
              $cookieStore.put('token', data.data.data.auth_token)
              deferred.resolve data.data.data
              cb()
        ,
          (err)=>
            @logout()
            deferred.reject data
            cb(err)
        )


]