<template>
  <div class="col-md-10 col-md-offset-1">
        <div v-if="mensaje" class="alert alert-success">
            <a href="#" class="close" aria-label="close" v-on:click="mensaje = undefined">&times;</a>
            {{ mensaje }}
        </div>
        <div class="panel panel-default">
            <div class="panel-heading panel-title text-center">
                Administración de periodos
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nombre Periodo</th>
                        <th class="text-center">Desde</th>
                        <th class="text-center">Hasta</th>
                        <th class="text-center">Etapa</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(periodo, index) in periodos" v-bind:key="periodo.id" :class="{ 'active' : index === 0 }">
                        <td class="text-center">{{ periodo.nombre }}</td>
                        <td class="text-center">{{ new Date(periodo.desde).toString() }}</td>
                        <td class="text-center">{{ new Date(periodo.hasta).toString() }}</td>
                        <td class="text-center">{{ etiquetas.etapa[periodo.etapa] }}</td>
                        <td class="col-md-2">
                          <router-link class="btn btn-xs btn-info" :to="{ name: 'editar-periodo', params: {accion: 'Editar', elemento: Object.assign({}, periodo, {}) } }">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                          </router-link>
                          <button v-on:click="deleteElem(periodo.id,index,periodo.nombre)" class="btn btn-xs btn-danger">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                          </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="panel-footer">
                <router-link class="btn btn-success" :to="{ name: 'crear-periodo', params: {accion: 'Crear'}}">     
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Periodo
                </router-link>
            </div>
        </div>
    </div>
 
</template>


<script>
    import {
        DELETE_PERIODO
    } from '../../vuex/actions'
    import { mapState } from 'vuex'
    export default {
        props: {
            mensaje: {
                type: String,
                required: false
            },
        },
        data: function() {
            return {
            }
        },
        methods: {
            /**
             * Callback para mostrar un mensaje luego de obtener respuesta
             * desde la API.
             * @param ok Indica si la operación se realizó correctamente
             * @param payload Data (respuesta) obtenida desde la API
             */
            callback: function(ok = false, payload) {
                this.$root.$emit('alert', {
                    mensaje: ok ? payload.mensaje : '<strong>Oh no!</strong> Ha ocurrido un error.',
                    class: ok ? 'success' : 'danger'
                })
            },
            deleteElem(id, index, nombre){
                if (confirm("Se eliminará el periodo \"" + nombre + "\". ¿Continuar?")) {
                    const payload = { mensaje: 'Se ha eliminado el periodo <strong>' + nombre + '</strong>' }
                    this.$store.dispatch(DELETE_PERIODO, { periodo: this.periodos[index], cb: this.callback, payload })
                }
            }
        },
        computed: mapState(['periodos'])
    }
</script>