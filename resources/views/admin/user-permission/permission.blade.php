<div id="perm">
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Menu</th>
            <th scope="col">Sub Menu</th>
            <th scope="col">Add	</th>
            <th scope="col">Edit</th>
            <th scope="col">Del</th>
            <th scope="col">View</th>
          </tr>
        </thead>
        <tbody>
        @if(count($permission)>0)
        @foreach($permission as $data)
        <?php
            $action = DB::table('action_masters')->where(['status'=>'1','parent_id'=>$data->id])->orderBy('display_order','ASC')->get();
        ?>
          <tr>
            <td>{{$data->show_in_menu ?? ''}}</td>
            <td>{{$data->action_title ?? ''}}</td>
            @if(count($action)>0)
            @foreach($action as $premission)
                <?php
                    $sub_action = DB::table('action_masters')->where(['status'=>'1','parent_id'=>$premission->id])->orderBy('display_order','ASC')->get();
                ?>
                @php
                if($action_route_count==0){
                    $checked = '';
                }else{
                $route_link = explode(',',$action_route->permission_id);
                //  dd($permission->id);
                $checked = in_array($premission->id,$route_link)  ? 'checked' : '';
                }
                @endphp
            <td>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="permissions[]" id="{{$premission->id}}" value="{{$premission->id}}" {{$checked}}> <label for="{{$premission->id}}">
              </div>
            </td>
            @endforeach
            @endif
            @php
                if($action_route_count==0){
                $checked = '';
                }else{
                $route_link = explode(',',$action_route->permission_id);
                //dd($route_link);
                $checked = in_array($data->id,$route_link)  ? 'checked' : '';
                }
            @endphp
            <td>
              <div class="custom-control custom-checkbox">
                  <input type="checkbox"name="permissions[]" id="{{$data->id}}" value="{{$data->id}}" {{$checked}}>
              </div>
            </td>
        @endforeach
        @endif
          </tr>
        </tbody>
      </table>
      <input type="hidden" name="user_id" value="{{$user_id}}">
    </div>
  </div>
</div>
