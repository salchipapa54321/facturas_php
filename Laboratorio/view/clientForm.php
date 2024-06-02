<form class="dataInvoice__section__div__form" method="POST" action="<?php ROUTE.'register' ?>">
                    <input class="dataInvoice__section__div__form__input" type="text" name="fullname" placeholder="Nombre Completo" required>
                    <input class="dataInvoice__section__div__form__input" type="text" name="id" placeholder="Numero de Documento" required>
                    <select class="dataInvoice__section__div__form__select" id="typeid" name="typeid" required>
                        <option class="dataInvoice__section__div__form__input__option" value="1">Cédula de Ciudadanía</option>
                        <option class="dataInvoice__section__div__form__input__option" value="2">Tarjeta de Identidad</option>
                        <option class="dataInvoice__section__div__form__input__option" value="3">NIT</option>
                    </select>
                    <input class="dataInvoice__section__div__form__input" type="tel" name="phone" pattern="[0-9]{10}" placeholder="Numero Telefono" required>
                    <input class="dataInvoice__section__div__form__input" type="text" name="mail" placeholder="Correo Electronico" required>
                    <input class="dataInvoice__section__div__form__input btn" type="submit" value="Registrar">
                </form>
                </div>
        </section>