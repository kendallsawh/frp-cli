<div class="card " id="confirm-card" style="padding: 30px; display: none;">
    <div class="tab-content">
        <div class="row">
            <h2>
                Please confirm that the application data is correct.
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </h2>
        </div>
        <form class="form-horizontal">
            <h4>Application Type</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Job:</label>
                <div class="col-lg-10" id="conf-job">{{$type['type']}}</div>
            </div>

            

           

            <h4>Organization Repressentatives</h4>
            @for($x=1; $x<=1; $x++)
            <h5><small>Rep {{$x}}</small></h5>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Avatar:</label>
                <img id="conf-avatar{{$x}}" src="{{asset('/img/default-avatar.png')}}" alt="Avatar" class="img-thumbnail avatar">
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">First Name:</label>
                <div class="col-lg-10" id="conf-app_fname{{$x}}">
                    {{old('app_fname'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Surname:</label>
                <div class="col-lg-10" id="conf-app_sname{{$x}}">
                    {{old('app_sname'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Contact:</label>
                <div class="col-lg-10" id="conf-contact{{$x}}">
                    {{old('contact'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">ID Type:</label>
                <div class="col-lg-10" id="conf-id_type{{$x}}">
                    {{old('id_type'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">ID Number:</label>
                <div class="col-lg-10" id="conf-id_num{{$x}}">
                    {{old('id_num'.$x)}}
                </div>
            </div>
            @endfor

            

            
        </form>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="farmerRegForm">Submit</button>
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </div>
        </div>
    </div>
</div>