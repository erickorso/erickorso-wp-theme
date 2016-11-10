<fieldset class="well">
    <legend>Oficina Central</legend>
    <div class="row">
        <div class="col-sm-12">
            <label> Nombre (requerido)
                [text* name class:form-control] </label>
            <label> Asunto (requerido)
                [text* subject class:form-control] </label>
            <label> Correo Electrónico (requerido)
                [email* email class:form-control] </label>
            <label> Comentarios (requerido)
                [textarea* description class:form-control] </label>
            [submit id:form-post-submit class:form-post-submit class:btn class:btn-info class:btn-lg "Enviar"]
            [recaptcha theme:dark]
        </div>
    </div>
</fieldset>
