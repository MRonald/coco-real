@extends('layouts.admin')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">
                        @if (isset($bill->id))
                            Editar
                        @else
                            Criar
                        @endif
                        Conta a Receber
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form class="form-validation" method="POST" action="{{ route('bills-in.store') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $bill->id ?? '' }}" />

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="user_id">Devedor</label>
                                                <select class="custom-select required-validation" id="user_id"
                                                    name="user_id">
                                                    <option selected disabled>Selecione</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"
                                                            @if (isset($bill->id) && $client->id === $bill->user_id) selected @endif>
                                                            {{ $client->id }} - {{ $client->name }} - {{ $client->email }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="history">Histórico</label>
                                                <textarea name="history" id="history" rows="4" class="form-control">{{ $bill->history ?? '' }}</textarea>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="value">Valor</label>
                                                <input type="number" name="value" id="value"
                                                    value="{{ $bill->value ?? '' }}"
                                                    class="form-control required-validation" step="0.01" min="0"
                                                    placeholder="0.00">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="nature">Natureza</label>
                                                <select name="nature" id="nature"
                                                    class="custom-select required-validation">
                                                    <option value="" selected disabled>Selecione</option>
                                                    <optgroup label="1: CUSTOS">
                                                        <option value="24"
                                                            @if (isset($bill) && $bill->nature === '24') selected @endif>
                                                            Alumínio
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="2: DESPESAS">
                                                    <optgroup label="2.1: DESPESAS FIXA PESSOAS">
                                                        <option value="9"
                                                            @if (isset($bill) && $bill->nature === '9') selected @endif>
                                                            Salário
                                                        </option>
                                                        <option value="10"
                                                            @if (isset($bill) && $bill->nature === '10') selected @endif>
                                                            Pró-labore
                                                        </option>
                                                        <option value="11"
                                                            @if (isset($bill) && $bill->nature === '11') selected @endif>
                                                            Encargos Funcionários - Alimentação
                                                        </option>
                                                        <option value="48"
                                                            @if (isset($bill) && $bill->nature === '48') selected @endif>
                                                            Encargos Funcionários - Vale Transporte
                                                        </option>
                                                        <option value="49"
                                                            @if (isset($bill) && $bill->nature === '49') selected @endif>
                                                            Encargos Funcionários - Assist. Médica e Odont.
                                                        </option>
                                                        <option value="50"
                                                            @if (isset($bill) && $bill->nature === '50') selected @endif>
                                                            Encargos Funcionários - Exames Pré e Demissionais
                                                        </option>
                                                        <option value="51"
                                                            @if (isset($bill) && $bill->nature === '51') selected @endif>
                                                            Encargos Funcionários - FGTS (8%)
                                                        </option>
                                                        <option value="52"
                                                            @if (isset($bill) && $bill->nature === '52') selected @endif>
                                                            Encargos Funcionários - INSS
                                                        </option>
                                                        <option value="53"
                                                            @if (isset($bill) && $bill->nature === '53') selected @endif>
                                                            Encargos Funcionários - Hora Extra
                                                        </option>
                                                        <option value="54"
                                                            @if (isset($bill) && $bill->nature === '54') selected @endif>
                                                            Encargos Funcionários - 13°
                                                        </option>
                                                        <option value="55"
                                                            @if (isset($bill) && $bill->nature === '55') selected @endif>
                                                            Encargos Funcionários - Férias
                                                        </option>
                                                        <option value="56"
                                                            @if (isset($bill) && $bill->nature === '56') selected @endif>
                                                            Encargos Funcionários - Rescisão
                                                        </option>
                                                        <option value="57"
                                                            @if (isset($bill) && $bill->nature === '57') selected @endif>
                                                            Provisionamento Funcinoários - 13° Salário (8,33%)
                                                        </option>
                                                        <option value="58"
                                                            @if (isset($bill) && $bill->nature === '58') selected @endif>
                                                            Provisionamento Funcionários - FGTS 13° Salário (0,70%)
                                                        </option>
                                                        <option value="59"
                                                            @if (isset($bill) && $bill->nature === '59') selected @endif>
                                                            Provisionamento - Férias (11,11%)
                                                        </option>
                                                        <option value="60"
                                                            @if (isset($bill) && $bill->nature === '60') selected @endif>
                                                            Provisionamento - FGTS Férias (0,90%)
                                                        </option>
                                                        <option value="61"
                                                            @if (isset($bill) && $bill->nature === '61') selected @endif>
                                                            Provisionamento - Rescisões (4%)
                                                        </option>
                                                        <option value="62"
                                                            @if (isset($bill) && $bill->nature === '62') selected @endif>
                                                            Distribuição de Lucros
                                                        </option>
                                                        <option value="77"
                                                            @if (isset($bill) && $bill->nature === '77') selected @endif>
                                                            Adiantamento Salario
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="2.2: DESPESAS FIXA INFRAESTRUTURA">
                                                        <option value="13"
                                                            @if (isset($bill) && $bill->nature === '13') selected @endif>
                                                            Água
                                                        </option>
                                                        <option value="14"
                                                            @if (isset($bill) && $bill->nature === '14') selected @endif>
                                                            Prestação do imóvel ou aluguel
                                                        </option>
                                                        <option value="15"
                                                            @if (isset($bill) && $bill->nature === '15') selected @endif>
                                                            Energia Elétrica
                                                        </option>
                                                        <option value="19"
                                                            @if (isset($bill) && $bill->nature === '19') selected @endif>
                                                            Impostos - Alvará
                                                        </option>
                                                        <option value="25"
                                                            @if (isset($bill) && $bill->nature === '25') selected @endif>
                                                            Impostos - Coleta de Lixo
                                                        </option>
                                                        <option value="26"
                                                            @if (isset($bill) && $bill->nature === '26') selected @endif>
                                                            Impostos - IPTU
                                                        </option>
                                                        <option value="27"
                                                            @if (isset($bill) && $bill->nature === '27') selected @endif>
                                                            Impostos - Taxa de Licença
                                                        </option>
                                                        <option value="28"
                                                            @if (isset($bill) && $bill->nature === '28') selected @endif>
                                                            Internet
                                                        </option>
                                                        <option value="29"
                                                            @if (isset($bill) && $bill->nature === '29') selected @endif>
                                                            Telefonia
                                                        </option>
                                                        <option value="30"
                                                            @if (isset($bill) && $bill->nature === '30') selected @endif>
                                                            Licença ou Aluguel de Softwares
                                                        </option>
                                                        <option value="31"
                                                            @if (isset($bill) && $bill->nature === '31') selected @endif>
                                                            Limpeza
                                                        </option>
                                                        <option value="32"
                                                            @if (isset($bill) && $bill->nature === '32') selected @endif>
                                                            Material Reforma
                                                        </option>
                                                        <option value="33"
                                                            @if (isset($bill) && $bill->nature === '33') selected @endif>
                                                            Manutenção Equipamentos
                                                        </option>
                                                        <option value="34"
                                                            @if (isset($bill) && $bill->nature === '34') selected @endif>
                                                            Manutenção dos Carros
                                                        </option>
                                                        <option value="35"
                                                            @if (isset($bill) && $bill->nature === '35') selected @endif>
                                                            Seguro dos Carros
                                                        </option>
                                                        <option value="36"
                                                            @if (isset($bill) && $bill->nature === '36') selected @endif>
                                                            Documentação dos Carros
                                                        </option>
                                                        <option value="37"
                                                            @if (isset($bill) && $bill->nature === '37') selected @endif>
                                                            Segurança
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="2.3: DESPESAS ADMINISTRATIVAS E COMERCIAIS">
                                                        <option value="38"
                                                            @if (isset($bill) && $bill->nature === '38') selected @endif>
                                                            Material de Escritório
                                                        </option>
                                                        <option value="39"
                                                            @if (isset($bill) && $bill->nature === '39') selected @endif>
                                                            Viagens
                                                        </option>
                                                        <option value="40"
                                                            @if (isset($bill) && $bill->nature === '40') selected @endif>
                                                            Cartório
                                                        </option>
                                                        <option value="41"
                                                            @if (isset($bill) && $bill->nature === '41') selected @endif>
                                                            Combustível e Translados
                                                        </option>
                                                        <option value="42"
                                                            @if (isset($bill) && $bill->nature === '42') selected @endif>
                                                            Estacionamento e Pedágio
                                                        </option>
                                                        <option value="43"
                                                            @if (isset($bill) && $bill->nature === '43') selected @endif>
                                                            Confraternizações
                                                        </option>
                                                        <option value="44"
                                                            @if (isset($bill) && $bill->nature === '44') selected @endif>
                                                            Correios
                                                        </option>
                                                        <option value="45"
                                                            @if (isset($bill) && $bill->nature === '45') selected @endif>
                                                            Cursos e Treinamentos
                                                        </option>
                                                        <option value="46"
                                                            @if (isset($bill) && $bill->nature === '46') selected @endif>
                                                            Marketing e Publicidade
                                                        </option>
                                                        <option value="47"
                                                            @if (isset($bill) && $bill->nature === '47') selected @endif>
                                                            Contabilidade
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="2.4: DESPESAS FINANCEIRAS">
                                                        <option value="64"
                                                            @if (isset($bill) && $bill->nature === '64') selected @endif>
                                                            Cheque Devolvido
                                                        </option>
                                                        <option value="65"
                                                            @if (isset($bill) && $bill->nature === '65') selected @endif>
                                                            Despesas Bancárias
                                                        </option>
                                                        <option value="66"
                                                            @if (isset($bill) && $bill->nature === '66') selected @endif>
                                                            Máquinas de Cartão - Taxas de antecipação
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="2.5: INVESTIMENTOS">
                                                        <option value="68"
                                                            @if (isset($bill) && $bill->nature === '68') selected @endif>
                                                            Aquisição de Equipamentos
                                                        </option>
                                                        <option value="69"
                                                            @if (isset($bill) && $bill->nature === '69') selected @endif>
                                                            Reserva de Emergência
                                                        </option>
                                                        <option value="70"
                                                            @if (isset($bill) && $bill->nature === '70') selected @endif>
                                                            Consórcios
                                                        </option>
                                                        <option value="71"
                                                            @if (isset($bill) && $bill->nature === '71') selected @endif>
                                                            Prestação de financiamentos
                                                        </option>
                                                        <option value="72"
                                                            @if (isset($bill) && $bill->nature === '72') selected @endif>
                                                            Empréstimos
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="2.6: OUTRAS DESPESAS">
                                                        <option value="74"
                                                            @if (isset($bill) && $bill->nature === '74') selected @endif>
                                                            Ajuste Caixa
                                                        </option>
                                                        <option value="75"
                                                            @if (isset($bill) && $bill->nature === '75') selected @endif>
                                                            Doação
                                                        </option>
                                                        <option value="76"
                                                            @if (isset($bill) && $bill->nature === '76') selected @endif>
                                                            Farmácia
                                                        </option>
                                                    </optgroup>
                                                    </optgroup>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="competence">Competência</label>
                                                <input type="text" name="competence" id="competence"
                                                    value="{{ isset($bill->competence) ? \Carbon\Carbon::parse($bill->competence)->format('m/Y') : \Carbon\Carbon::now()->format('m/Y') }}"
                                                    class="form-control month-year-datepicker required-validation">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="due_date">Data de Vencimento</label>
                                                <input type="text" name="due_date" id="due_date"
                                                    value="{{ isset($bill->due_date) ? \Carbon\Carbon::parse($bill->due_date)->format('d/m/Y') : '' }}"
                                                    class="form-control datepicker">
                                                <div class="invalid-feedback"></div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="nf_issue">Emissão da NF</label>
                                                <input type="text" name="nf_issue" id="nf_issue"
                                                    value="{{ isset($bill->nf_issue) ? \Carbon\Carbon::parse($bill->nf_issue)->format('d/m/Y') : '' }}"
                                                    class="form-control datepicker">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            @if (isset($bill->id))
                                                Atualizar
                                            @else
                                                Cadastrar
                                            @endif
                                        </button>
                                    </form>
                                </div> <!-- /. card-body -->
                            </div> <!-- /. card -->
                        </div> <!-- /. col -->
                    </div> <!-- /. end-section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
@endsection
