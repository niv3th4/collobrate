angular.module 'Pyoopil.Services'
.factory 'CSBase', ['EventEmitter','Utilities', 'Form', '$cookieStore', 'Notify',
  (EventEmitter, Utilities, Form, $cookieStore, Notify)->

    class CSBase extends EventEmitter

      constructor: ->

        @path = Utilities.getPath()

        @path += 'Classrooms/'

      init : (scope)->

        super scope

        @path = Utilities.getPath()

        @path += 'Classrooms/'

        @currentClassroom = @getCurrentClassroom()

        @$scope.pageNo = 1

        @addListeners()

      addListeners : ->

        @$scope.$on 'END.Scroll', (evt)=> @loadMoreData evt
        @$scope.$on '$destroy', => @destroyScope

      getData : (url)->

        path = @path + url

        Form.getData(path)

      postData : (url, data)->

        path = @path + url

        Form.postData(data, path)

      getDatum : () ->

        path = @getUrl + @$scope.pageNo

        promise = @getData(path)

        promise.then(
          (data)=>
#            PERMISSIONS TO COME BACK ALONG WITH LOGIN
            @$scope.permissions = data.data.permissions
            @getCallback(data.data.data)
            if not @$scope.$$phase
              @$scope.$digest()
        )

      rendered : ->

        @emit 'UPDATE.Scroll', true


      loadMoreData : (evt)->

        @$scope.pageNo += 1

        @getDatum()

      getCurrentClassroom : ->

        $cookieStore.get 'classroom'

      setCurrentClassroom : (id) =>

        $cookieStore.remove 'classroom'

        $cookieStore.put 'classroom', id

      postForm : (url, data)=>

        promise = @postData url, data

        promise.then(
          (data)=>
            @getCallback(data.data.data)
        )

      destroyScope : ->

        @$scope.pageNo = 1
        @path = false
        @currentClassroom = false






]