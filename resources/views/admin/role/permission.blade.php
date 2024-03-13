@extends('layouts.admin.master', ['page_title' => 'Roles'])
@section('content')
    <style type="text/css">
        ul,
        li {
            list-style-type: none;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <h3 class="page-title">Manage Permissions</h3>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="main-content-wrap sidenav-open d-flex flex-column mt-5">

                <form action="{{ url('admin/role-permission/update') }}" method="post">
                    @csrf


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            @if (count($permission) > 0)
                                @foreach ($permission as $data)
                                    <?php
                                    $action = DB::table('action_masters')
                                        ->where(['status' => '1', 'parent_id' => $data->id])
                                        ->orderBy('display_order', 'ASC')
                                        ->get();
                                    ?>
                                    @php
                                        if ($action_route_count == 0) {
                                            $checked = '';
                                        } else {
                                            $route_link = explode(',', $action_route->permission_id);
                                            //dd($route_link);
                                            $checked = in_array($data->id, $route_link) ? 'checked' : '';
                                        }
                                    @endphp
                                    <li>
                                        <input type="checkbox" name="permissions[]" id="{{ $data->id }}"
                                            value="{{ $data->id }}" {{ $checked }}> <label
                                            for="{{ $data->id }}"> {{ $data->action_title }} </label>
                                        <ul>
                                            @if (count($action) > 0)
                                                @foreach ($action as $premission)
                                                    <?php
                                                    $sub_action = DB::table('action_masters')
                                                        ->where(['status' => '1', 'parent_id' => $premission->id])
                                                        ->orderBy('display_order', 'ASC')
                                                        ->get();
                                                    ?>
                                                    @php
                                                        if ($action_route_count == 0) {
                                                            $checked = '';
                                                        } else {
                                                            $route_link = explode(',', $action_route->permission_id);
                                                            //  dd($permission->id);
                                                            $checked = in_array($premission->id, $route_link) ? 'checked' : '';
                                                        }
                                                    @endphp
                                                    <li>
                                                        <input type="checkbox" name="permissions[]"
                                                            id="{{ $premission->id }}" value="{{ $premission->id }}"
                                                            {{ $checked }}> <label
                                                            for="{{ $premission->id }}">{{ $premission->action_title }}</label>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <hr>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="role_id" value="{{ $role_id }}">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="" class="btn  btn-danger"><i class="metismenu-icon"></i>Cancel</a>
            </div>
            <div class="text-center">
                <div class="error"></div>
            </div>
        </div>
    </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $('input[type=checkbox]').click(function() {
            $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
            var sibs = false;
            $(this).closest('ul').children('li').each(function() {
                if ($('input[type=checkbox]', this).is(':checked')) sibs = true;
            })
            $(this).parents('ul').prev().prop('checked', sibs);
        });
    </script>
@endpush
