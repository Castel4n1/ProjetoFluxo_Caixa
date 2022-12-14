@extends('layouts.base')

@section('conteudo')
    
    <h1>
        @if($lancamento)
        Atualizar Lançamentos
        @else
        Novo Lançamento
        @endif
    </h1>
    @if ($lancamento)
        <form action="{{ route('lancamento.update', ['id'=>$lancamento->id_lancamento ]) }}" method="post" enctype="multipart/form-data">        
    @else
        <form action="{{ route('lancamento.store') }}" method="post" enctype="multipart/form-data">        
    @endif
        @csrf
        <div class="row">
            
            <div class="form-group col-md-4">
                <label for="id_centro_custo" class="form-label">CentroCusto*</label>
                <select name="id_centro_custo" id="id_centro_custo" class="form-control" required>
                <option value="">Selecione</option>
                <optgroup label="Entradas">
                    @foreach ($entradas->get() as $centroCustos)
                        <option value="{{ $centroCustos->id_centro_custo }}"
                        {{
                            (
                                $lancamento 
                                && 
                                $lancamento->id_centro_custo == $centroCustos->id_centro_custo  
                            )
                            ?
                            'selected' 
                            : 
                            ''
                        }}    
                            >
                            {{ $centroCustos->centro_custo }}
                        </option>
                    @endforeach                    
                </optgroup>

                <optgroup label="Saidas">                    
                    @foreach ($saidas->get() as $centroCustosUm)
                        <option value="{{ $centroCustosUm->id_centro_custo }}"
                        {{
                        (
                            $lancamento
                            && 
                            $lancamento->id_centro_custo == $centroCustosUm->id_centro_custo  
                        )
                            ?
                            'selected' 
                            : 
                            ''
                        }}    
                        >
                            {{ $centroCustosUm->centro_custo }}
                        </option>
                    @endforeach 
                </optgroup>                
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="dt_faturamento" class="form-label">DT Faturamento*</label>
                <input type="date" name="dt_faturamento" id="dt_faturamento" class="form-control" value="{{ $lancamento ? $lancamento->dt_faturamento->format('d-m-Y') : old('dt_faturamento') }}" required>
            </div>

            <div class="form-group col-md-2">
                <label for="valor" class="form-label">Valor*</label>
                <input type="number" name="valor" id="valor" class="form-control" min="0" value ="{{ $lancamento ? $lancamento->valor : old('valor')}}" required>
            </div>

            <div class="form-group col-md-12">
                <label for="descricao" class="form-label">Descricao*</label>
                <textarea name="descricao" id="descricao" rows="2" class="form-control" placeholder="Digite sua o porque do seu lançamento aqui..">{{ $lancamento ? $lancamento->descricao : old('descricao')}}</textarea>
            </div>

            <div class="form-group col-md-12">
                <label for="arquivo" class="form-label">Arquivo</label>
                <input type="file" name="arquivo" id="arquivo" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <br>
                <input type="submit" value=" {{ $lancamento ? 'Atualizar' : 'Cadastrar'}}" class="btn btn-primary mt-2">
            </div>
        </div>
    </form>
@endsection