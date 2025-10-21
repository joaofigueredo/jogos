<x-layout title="Editar Perfil">
    <form action="{{ route('login.update') }}" method="POST">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Editar perfil</h2>
                                    <form action="{{ route('login.store') }}" method="POST">
                                        @csrf
                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="name" name="name"
                                                class="form-control form-control-lg" autofocus
                                                value="{{ $usuario->name }}" />
                                            <label class="form-label texto-login" for="nome">Nome</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="email" name="email" id="typeEmailX"
                                                class="form-control form-control-lg" value="{{ $usuario->email }}" />
                                            <label class="form-label texto-login" for="typeEmailX">Email</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <input type="text" id="idXbox" name="idXbox"
                                                        class="form-control form-control-lg"
                                                        value="{{ $usuario->idXbox }}" />
                                                    <label class="form-label texto-login" for="idXbox">ID Xbox</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <input type="text" id="idPs" name="idPs"
                                                        class="form-control form-control-lg"
                                                        value="{{ $usuario->idPs }}" />
                                                    <label class="form-label texto-login" for="idPs">ID
                                                        Playstation</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <a class="btn btn-outline-light btn-lg px-5"
                                                    href="{{ route('home.jogos') }}">Cancelar</a>
                                            </div>
                                            <div class="col-6">
                                                <button data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-outline-light btn-lg px-5"
                                                    type="submit">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</x-layout>