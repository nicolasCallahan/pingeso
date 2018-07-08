import Vue from 'vue'
import VueRouter from 'vue-router'
import { EtapasEnum } from './const'
import store from './vuex/store'

Vue.use(VueRouter)

import Inicio from './components/Inicio'
import ListaInformes from './components/informe/Lista'
import Formulario from './components/informe/formulario/Formulario'
import ListaUsuarios from './components/usuario/Lista'
import Usuario from './components/usuario/Usuario'
import ListadoFacultades from './components/facultad/ListadoFacultades'
import FormFacultad from './components/facultad/FormFacultad'
import ListadoDepartamentos from './components/departamento/ListadoDepartamentos'
import FormDepartamento from './components/departamento/FormDepartamento'
import ListadoRangos from './components/rango/ListadoRangos'
import FormRango from './components/rango/FormRango'
import ListadoJerarquias from './components/jerarquia/ListadoJerarquias'
import FormJerarquia from './components/jerarquia/FormJerarquia'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/inicio',
            name: 'inicio',
            component: Inicio,
        },
        {
            path: '/usuarios',
            name: 'usuarios',
            component: ListaUsuarios,
            props: true,
            meta: { eval: 'rol === 2 || rol === 4' }
        },
        {
            path: '/usuarios/crear',
            name: 'nuevo-usuario',
            component: Usuario,
            props: { editable: true },
            meta: { eval: 'rol === 2 || rol === 4' }
        },
        {
            path: '/usuarios/:id',
            name: 'editar-usuario',
            component: Usuario,
            props: { editable: true },
            meta: { eval: 'rol === 2 || rol === 4' }
        },
        {
            path: '/informes',
            name: 'informes',
            component: ListaInformes,
            props: true,
            meta: { eval: 'rol < 4' }
        },
        {
            path: '/informes/declarar',
            name: 'nuevo-informe',
            component: Formulario,
            props: { etapa: EtapasEnum.declarando },
            meta: { eval: 'rol === 1' }
        },
        {
            path: '/informes/:id',
            name: 'editar-informe',
            component: Formulario,
            props: { etapa: EtapasEnum.declarando },
            meta: { eval: 'rol === 1' }
        },
        {
            path: '/informes/:id',
            name: 'aprobar-informe',
            component: Formulario,
            props: { etapa: EtapasEnum.aprobando },
            meta: { eval: 'rol === 2' }
        },
        {
            path: '/informes/:id',
            name: 'realizado-informe',
            component: Formulario,
            props: { etapa: EtapasEnum.realizado },
            meta: { eval: 'rol === 1' }
        },
        {
            path: '/informes/:id',
            name: 'evaluar-informe',
            component: Formulario,
            props: { etapa: EtapasEnum.evaluando },
            meta: { eval: 'rol === 3' }
        },
        {
            path: '/informes/:id',
            name: 'apelar-informe',
            component: Formulario,
            props: { etapa: EtapasEnum.apelando },
            meta: { eval: 'rol === 1' }
        },
        {
             path: '/facultades',
             name: 'facultades',
             component: ListadoFacultades,
             meta: { eval: 'rol === 4'},
             props: true
         },
         {
             path: '/facultades/crear',
             name: 'crear-facultad',
             component: FormFacultad,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/facultades/editar',
             name: 'editar-facultad',
             component: FormFacultad,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/departamentos',
             name: 'departamentos',
             component: ListadoDepartamentos,
             meta: { eval: 'rol === 4'},
             props: true
         },
         {
             path: '/departamentos/crear',
             name: 'crear-departamento',
             component: FormDepartamento,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/departamentos/editar',
             name: 'editar-departamento',
             component: FormDepartamento,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/rangos',
             name: 'rangos',
             component: ListadoRangos,
             meta: { eval: 'rol === 4'},
             props: true
         },
         {
             path: '/rangos/crear',
             name: 'crear-rango',
             component: FormRango,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/rangos/editar',
             name: 'editar-rango',
             component: FormRango,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/jerarquias',
             name: 'jerarquias',
             component: ListadoJerarquias,
             meta: { eval: 'rol === 4'},
             props: true
         },
         {
             path: '/jerarquias/crear',
             name: 'crear-jerarquia',
             component: FormJerarquia,
             props: true,
             meta: { eval: 'rol === 4'}
         },
         {
             path: '/jerarquias/editar',
             name: 'editar-jerarquia',
             component: FormJerarquia,
             props: true,
             meta: { eval: 'rol === 4'}
         },
    ],
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.eval)) {
        const toEval = to.matched.find(record => record.meta.eval).meta.eval
        if (!eval(toEval.replaceAll('rol', store.state.auth.rol.id))) {
            next({
                name: 'inicio'
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

export { router }