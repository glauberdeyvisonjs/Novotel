@extends('layouts.app')

@section('title', 'Bem-vindo ao Novotel')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Bem-vindo ao <strong>Novotel</strong></h1>
            <p class="lead">Sistema de gerenciamento de reservas para hotéis com acesso dedicado para clientes e
                equipe.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-primary shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Acesso para Funcionários</h4>
                    </div>
                    <div class="card-body text-center">
                        <p>Área administrativa do hotel. Controle de reservas, clientes e relatórios.</p>
                        <a href="{{ route('staff.login') }}" class="btn btn-primary">Login Staff</a>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mt-4 mt-md-0">
                <div class="card border-success shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Acesso para Clientes</h4>
                    </div>
                    <div class="card-body text-center">
                        <p>Acesse seus dados, reservas e aproveite todos os benefícios do Novotel.</p>
                        <a href="{{ route('client.login') }}" class="btn btn-success">Login Cliente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
