app = angular.module('Pyoopil.Controllers')

class discussionsCtrl extends BaseCtrl

  @register app
  @inject '$scope', 'Notify', 'FileUploader', '$document', 'discussionService'

  initialize : ->

    @$scope.Discussion = {}
    @$scope.isSubmitted = false
    @$scope.choices = []

    @$scope.uploader = new @FileUploader({
      filters : [{
        name : 'singleUpload',
        fn : (item, options) ->
          return @queue.length is 0
      }]
    })

    @$scope.ckeditorOptions = {
      height : '200px'
    }

    @discussionService.init @$scope

    @addListeners()

  addListeners : ->

    @$scope.$on 'UPDATE.DiscussionType', (evt, data)=> @changeDiscussion evt, data
    @$scope.submit = (e) => @submit(e)
    @$scope.deleteChoice = @deletePollChoice

    @$document.on 'click', '.add-choice', (evt) => @addPollChoice evt

  changeDiscussion : (evt, data) ->

    @$scope.Discussion.type = data.name

    if not @$scope.$$phase
      @$scope.$digest()

  addPollChoice : (evt)->

    if @$scope.choices.length < 6
      idx = _.uniqueId('choice_')
      @$scope.choices.push {id : idx }

      if not @$scope.$$phase
        @$scope.$digest()

  deletePollChoice : (id)=>

    if not id?
      return

    @$scope.choices = _.reject @$scope.choices, (choice, predicate)-> choice.id is id

    if not @$scope.$$phase
      @$scope.$digest()

  submit : (e) ->

    @$scope.isSubmitted = true

    if not @$scope.$$phase
      @$scope.$digest()

    form = @$scope.discussionForm

    if form.$invalid
      @Notify.alert 'Please enter valid details', 'error'
      return

    if form.$valid
      choices = angular.element('.poll-choice input')
      data = {}

      if @$scope.Discussion.type is 'poll'
        data.Pollchoice = {}

        angular.forEach choices, (choice, idx)=>
          data.Pollchoice[idx] = {}
          data.Pollchoice[idx]['choice'] = choice.value

      data["Discussion"] = @$scope.Discussion

      @discussionService.postForm 'add.json', data, (data) -> @emit 'READ.Discussions', data
      @$scope.isSubmitted = false
      @$scope.Discussion = {}







