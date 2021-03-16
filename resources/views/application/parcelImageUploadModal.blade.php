<div class="modal fade" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="imageUploadLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="imageUploadLabel"></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card-content" >

                        <div class="content">
                            <div class="container-fluid">
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-profile">

                                                <div class="card-content">
                                                    <div class="row">

                                                       
                                                        
                                                        <form method="POST" action="{{route('uploadImage')}}" id="parcelImageUpload"  enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" id="app_id" name="app_id" value="{{$data->id}}">
                                                            

                                                            
                                                            <div class="row">
                                                                <div class="col-md-6 ">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" >
                                                                            <i class="material-icons">perm_identity</i>
                                                                        </span>
                                                                        <div id="grp-parcel" class="form-group{{ $errors->has('parcel') ? ' has-error' : '' }} label-floating">
                                                                            <label class="control-label">Select Parcel Address<span class="red">*</span></label>
                                                                            <select id="parcel" name="parcel" class="form-control dropdown" >
                                                                                <option disabled="" selected=""></option>
                                                                                @foreach($data->parcels() as $parcel)
                                                                                <option value="{{$parcel->id}}" {{old('parcel')==$parcel->id ? 'selected' : '' }}>{{$parcel->land->address->address}}</option>
                                                                                @endforeach
                                                                            </select>

                                                                            <span class="help-block">
                                                                                <strong id="err-parcel">{{ $errors->first('parcel') }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="material-icons">credit_card</i>
                                                                    </span>
                                                                    <div id="grp-image-upload" class="form-group{{ $errors->has('image-upload') ? ' has-error' : '' }} label-floating">

                                                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" >
                                                                            <label class="control-label">   Upload Image</label>
                                                                            <input id="image_file" class="" name="image_file[]" type="image*" multiple style="opacity: inherit;position: relative; padding-top:10px">
                                                                        </div>
                                                                        <span class="help-block">
                                                                            <strong id="err-image-upload">{{ $errors->has('image-upload') ? $errors->first('image-upload') : 'Select at least one type of identification' }}</strong>
                                                                        </span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            
                                                        </form>
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                      
                                
                            </div>
                        </div>

                    </div>
                </div>

            </div>


            <div class="modal-footer">

                <button type="submit" class="btn btn-fill btn-success" form="parcelImageUpload">Upload</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

