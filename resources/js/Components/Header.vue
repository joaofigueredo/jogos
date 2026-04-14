<template>
    <h1>Header</h1>
    <p v-if="showUsuario === 'desenvolvedor'">Usuario: desenvolvedor;</p>
    <p v-if="showUsuario === 'usuario'">Usuario: Usuario;</p>
    <p v-if="showUsuario === 'admin'">Usuario: Admin;</p>
    <ul>
        <li class="contas" v-for="i in dados" :vkey="i.id">{{ i.nome }} tem R${{ i.saldo }}.00 em sua conta!</li>
    </ul>

    
        <div>
        <label /> Nome:
        <input v-model="nome" value="João" type="text">
        <br>
        {{ nome }}
        <br>
        <br>
        <input v-model="contrato" type="checkbox"> <br>
        {{ contrato }}

    </div>
</template>

<script>
    export default {
        name: "Header",
        data() {
             return {
                showUsuario: 'desenvolvedor',
                dados: [
                    {id:1, nome: 'João', saldo: 300},
                    {id:2, nome: 'Maria', saldo: 500},
                    {id:3, nome: 'Jose', saldo: 1000},
                ],
            nome: "",
            contrato: true,
            }
        }
    }

</script>

<style>
h1 {
    text-align: center;
    color:purple;
}
p{
    color: yellow;
    text-align: center;
}
.contas {
    color: green;
    text-align: center;
    list-style: none;
    
}

</style>