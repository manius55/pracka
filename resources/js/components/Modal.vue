<template>
    <Transition name="modal">
        <div v-if="show" class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container col-6">
                    <div class="modal-header h5">
                        <slot name="header">Usuwanie</slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <div class="h4 text-center">
                            Czy na pewno chcesz usunąć użytkownika abc?
                            </div>
                        </slot>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <slot name="footer">
                            <button
                                class="btn btn-success col-2"
                                @click="$emit('confirm')"
                            >
                                Tak
                            </button>

                            <button
                                class="btn btn-danger col-2"
                                @click="$emit('close')"
                            >
                                Anuluj
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    name: "Modal",
    props: {
        show: Boolean,
    }
}
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 80px 0;
}

.modal-default-button {
}

.modal-enter-from {
    opacity: 0;
}

.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>
