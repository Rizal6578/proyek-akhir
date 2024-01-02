@extends('Master.Layouts.app_login', ['title' => $title])

@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6">
            <div class="d-flex justify-content-center align-items-center">
                @if ($web->web_logo == '' || $web->web_logo == 'default.png')
                    <img src="{{ url('/assets/default/web/default.png') }}" height="75px" class="" alt="logo">
                @else
                    <img src="{{ asset('storage/web/' . $web->web_logo) }}" height="75px" class="" alt="logo">
                @endif
            </div>
            <div class="text-center">
                <h4 class="fw-bold mt-4 text-black text-uppercase text-truncate">{{ $web->web_nama }} <span
                        class="text-gray">| REGISTER</span></h4>
            </div>
            <form class="login100-form validate-form" method="POST" name="myForm"
                action="{{ url('admin/prosesregister') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab5">

                                <div class="wrap-input100 validate-input input-group"
                                    data-bs-validate="Valid Nama Lengkap is required">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-assignment-account text-muted ms-1" aria-hidden="true"></i>
                                    </a>
                                    <input name="nmlengkap" value="{{ Session::get('userInput') }}"
                                        class="input100 border-start-0 form-control ms-0" type="text"
                                        placeholder="Nama Lengkap" autocomplete="off">
                                </div>

                                <div class="wrap-input100 validate-input input-group"
                                    data-bs-validate="Valid username is required">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-account text-muted ms-1" aria-hidden="true"></i>
                                    </a>
                                    <input name="user" value="{{ Session::get('userInput') }}"
                                        class="input100 border-start-0 form-control ms-0" type="text"
                                        placeholder="Username" autocomplete="off">
                                </div>

                                <div class="wrap-input100 validate-input input-group"
                                    data-bs-validate="Valid Email is required">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-email text-muted ms-1" aria-hidden="true"></i>
                                    </a>
                                    <input name="email" value="{{ Session::get('userInput') }}"
                                        class="input100 border-start-0 form-control ms-0" type="email" placeholder="Email"
                                        autocomplete="off">
                                </div>

                                <div class="wrap-input100 validate-input input-group">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-share text-muted ms-1" aria-hidden="true"></i>
                                    </a>
                                    <select name="role" class="input100 border-start-0 form-control ms-0">
                                        <option value="">Pilih Role</option>
                                        @foreach ($role as $r)
                                            <option value="{{ $r->role_id }}">{{ $r->role_title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input name="pwd" class="input100 border-start-0 form-control ms-0" type="password"
                                        placeholder="Password" autocomplete="off">
                                </div>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <a tabindex="-1" href="javascript:void(0)"
                                        class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input name="pwdU" class="input100 border-start-0 form-control ms-0" type="password"
                                        placeholder="Ulangi Password" autocomplete="off">
                                </div>
                                <!-- <div class="text-end pt-4">
                                                                <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a></p>
                                                            </div> -->
                                <div class="container-login100-form-btn mb-4">
                                    <button type="button" class="login100-form-btn btn btn-primary d-none"
                                        id="btnLoader" type="button" disabled="">
                                        <span class="spinner-border spinner-border-sm me-1" role="status"
                                            aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                    <button type="submit" class="login100-form-btn btn btn-primary"
                                        id="btnLogin">Submit</button>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div style="border-bottom: 1px solid gray;width: 100%;"></div>
                                    <p class="pt-2">Atau</p>
                                    <div style="border-bottom: 1px solid gray;width: 100%;"></div>
                                </div>

                                <div class="text-center">
                                    <a href="{{ url('admin/login') }}" class="text-primary ms-1"
                                        style="text-decoration: underline">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function validateForm() {
            var nmlengkap = document.forms["myForm"]["nmlengkap"].value;
            var email = document.forms["myForm"]["email"].value;
            var usr = document.forms["myForm"]["user"].value;
            var role = document.forms["myForm"]["role"].value;
            var pwd = document.forms["myForm"]["pwd"].value;
            var pwdU = document.forms["myForm"]["pwdU"].value;

            setLoading(true);

            if (nmlengkap == "") {
                validasi('Nama Lengkap masih kosong!', 'warning');
                setLoading(false);
                return false;
            } else if (usr == "") {
                validasi('Username masih kosong!', 'warning');
                setLoading(false);
                return false;
            } else if (email == "") {
                validasi('Email masih kosong!', 'warning');
                setLoading(false);
                return false;
            }else if (role == "") {
                validasi('Role belum di pilih!', 'warning');
                setLoading(false);
                return false;
            } else if (pwd == '') {
                validasi('Password masih kosong!', 'warning');
                setLoading(false);
                return false;
            } else if (pwdU == '') {
                validasi('Ulangi Password masih kosong!', 'warning');
                setLoading(false);
                return false;
            } else if (pwd !== pwdU) {
                validasi('Password tidak sama!', 'warning');
                setLoading(false);
                return false;
            }
        }

        function setLoading(bool) {
            if (bool == true) {
                $('#btnLoader').removeClass('d-none');
                $('#btnLogin').addClass('d-none');
            } else {
                $('#btnLogin').removeClass('d-none');
                $('#btnLoader').addClass('d-none');
            }
        }

        function validasi(judul, status) {
            swal({
                title: judul,
                type: status,
                confirmButtonText: "OK"
            });
        }
    </script>
@endsection
