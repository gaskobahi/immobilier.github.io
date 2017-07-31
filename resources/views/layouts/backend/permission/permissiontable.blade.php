<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Liste des permissions
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover tablepermission" id="dataTables-permission">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Pseudo</th>
                            <th>Description</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody class="tbdpermission">

                        @foreach ($permissions as $permission)
                            <tr id="row_{{ $permission->id }}" class="permission">
                                <td id="permission_id_{{ $permission->id }}" >{!! $permission->id !!}</td>
                                <td id="permission_name_{{ $permission->id }}">{!! $permission->name !!}</td>
                                <td id="permission_diplay_name_{{ $permission->id }}" >{!! $permission->display_name !!}</td>
                                <td id="permission_description_{{ $permission->id }}">{!! $permission->description !!}</td>
                                <td>
                                    <a class="apermission fa fa-pencil-square-o aria-hidden=true " href="#" onclick="editPermission({{$permission->id }})"></a>
                                    <a href="#" onclick="deletePermission({{ $permission->id }})" class="delpermission fa fa-trash alert-danger" aria-hidden="true"></a>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<a class="btn btn-primary"  href="{{ route('permission.create') }}">
    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
    Ajouter un permission</a>