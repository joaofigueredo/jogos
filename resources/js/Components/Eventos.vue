<template>
    <div>
        <button @click="onClick">Enviar</button>
        <div 
            @mouseover="onMouseOver()" 
            @mouseout="onMouseOut()">
                Mouse
        </div>
    </div>
</template>

<script>
export default {
    name: "Eventos",
    data() {

    },
    methods: {
        onClick($evt) {
            alert('Clicou', $evt);
        },
        onMouseOver($evt) {
            alert('mouse over', $evt);
        },
        onMouseOut($evt) {
            alert('Mouse out', $evt);
        }
    }
}
</script>

<style>

</style>