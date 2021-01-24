<div class="table-responsive">
    <table class="table align-items-center">
        <thead class="thead-light">
        <tr>
            <th scope="col">Dateiname</th>
            <th scope="col">Folien</th>
            <th scope="col">Vorschau</th>
            <th scope="col">Aktionen</th>
        </tr>
        </thead>
        <tbody>
        @foreach (\App\Models\File::all() as $fileName)

            <tr>
                <th scope="row">
                    <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                            <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                        </a>
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $fileName->name}}</span>
                        </div>
                    </div>
                </th>
                <td>
                    {{ $fileName->slidesCount() }}
                </td>

                <td>
                    <a href="{{ $fileName->getUrl() }}">Vorschau</a>
                </td>
                <td class="text-right">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

</div>
