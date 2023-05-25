<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 9 CRUD Tutorial Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .container {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }

        /* Center the h2 element */
        h2 {
            text-align: center;
        }

        /* Add some aesthetic styling */
        .btn-create {
            margin-bottom: 10px;
        }

        table {
            margin-top: 20px;
        }

        .thead-dark th {
            text-align: center;
        }

        .btn-action {
            margin-right: 5px;
        }

        .action-icons {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Company Crud</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-success btn-create" data-toggle="modal" data-target="#createCompanyModal">
                        <i class="fas fa-plus"></i> Add Company
                    </button>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>S.No</th>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Contact</th>
                    <th>Company Address</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody style="text-align:center;">
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->contact }}</td>
                        <td>{{ $company->address }}</td>
                        <td>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" id="deleteForm{{ $company->id }}">
                                <a class="btn btn-primary btn-action" href="{{ route('companies.edit', $company->id) }}">
                                    <i class="fas fa-edit action-icons"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-action" onclick="deleteCompany({{ $company->id }})">
                                    <i class="fas fa-trash-alt action-icons"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $companies->links() !!}
    </div>

    <!-- Create Company Modal -->
    <div class="modal fade" id="createCompanyModal" tabindex="-1" role="dialog" aria-labelledby="createCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCompanyModalLabel">Create Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form elements for creating a company here -->
                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="companyName">Company Name:</label>
                            <input type="text" name="name" class="form-control" id="companyName" placeholder="Company Name">
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="companyEmail">Company Email:</label>
                            <input type="email" name="email" class="form-control" id="companyEmail" placeholder="Company Email">
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="companyContact">Company Contact:</label>
                            <input type="text" name="contact" class="form-control" id="companyContact" placeholder="Company Contact">
                            @error('contact')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="companyAddress">Company Address:</label>
                            <input type="text" name="address" class="form-control" id="companyAddress" placeholder="Company Address">
                            @error('address')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check action-icons"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function deleteCompany(companyId) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to delete this company?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form after confirmation
                    document.getElementById('deleteForm' + companyId).submit();
                }
            });
        }
    </script>
</body>
</html>
