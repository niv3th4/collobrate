angular.module 'Pyoopil.Services'
  .factory 'Auth', ['$cookieStore', '$q', 'Form', ($cookieStore, $q, Form)->

    new class Auth

      constructor : ->

        @getAuthToken()


      getAuthToken : ->

        @token = $cookieStore.get('token') || false

      authorize : (callback)->

        @currentUser = @getCurrentUser()

        @currentUser.then(

          (data)->

            callback(true)
          ,
          (err)->

            callback(false)

        )

#        if @currentUser.hasOwnProperty '$promise'
#          console.log @currentUser

      setCurrentUser : (user)->

        @currentUser = user

#      To be updated from back-end
      getCurrentUser : ->

        defer = $q.defer()

        token = @getAuthToken()

        if token? and token
#          Form.getData
          defer.resolve token
        else
          defer.reject token

        defer.promise




      logout : ->

        $cookieStore.remove 'token'
        @currentUser = {}

        true

]