<div class="modal fade bd-example-modal-lg" id="formModel" tabindex="-1" role="dialog"
     aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formSubmit">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="titleOfModel"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">title</label>
                                <input type="text" id="title" name="title" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">contact phone</label>
                                <input type="text" id="phone" name="phone" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">description</label>
                                <textarea type="text" id="description" name="description"  class="form-control" ></textarea>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">user</label>
                                <select id="user_id" name="user_id" required class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="err"></div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    <button type="submit" id="save" class="btn btn-success"><i class="ti-save"></i> save</button>
                </div>
            </form>
        </div>
    </div>
</div>
