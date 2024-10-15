<div>

    <div>
        <div style="display: flex; justify-content: space-around">
            <div>
                <x-label>
                    <h1 class="display-2">Datos del paciente</h1>
                </x-label>

                <div style="height: 300px">
                    <x-labeL>
                        Ultimos Signos Vitales
                    </x-labeL>

                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                Altura
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>Cm
                        </div>
                    </div>


                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                Peso
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>Kg
                        </div>
                    </div>

                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                IMC
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>mbi
                        </div>
                    </div>

                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                PI
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>
                        </div>
                    </div>

                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                PA
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>mmHg
                        </div>
                    </div>

                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                SpO2
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>
                        </div>
                    </div>

                    <div style="display: flex">
                        <div style="width: 50px">
                            <x-label>
                                F.C.
                            </x-label>
                        </div>

                        <div>
                            <x-input style="width: 50px" disabled></x-input>f.c
                        </div>
                    </div>

                </div>
            </div>


            <div>
                <div style="height: 300px">
                    <X-label>
                        Documentos del paciente
                    </X-label>

                    <div>
                        <table>
                            <thead>
                                <td> Codigo </td>
                                <td> Fecha</td>
                            </thead>
                            <tbody>
                                <td></td>
                                <td></td>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="height: 300px">
                    <x-label>
                        Detalles
                    </x-label>

                    <div>
                        <x-textarea></x-textarea>
                    </div>
                </div>
            </div>

            <div>
                <div style="height: 80px">
                    <x-button>
                        Nueva Consulta
                    </x-button>
                </div>

                <div>
                    <x-label>
                        Consultas Agendadas
                    </x-label>
                </div>

            </div>

        </div>
    </div>
</div>
