//логика простая. Получаем элементы, перебираем при изменении select
const typeSelect = document.querySelector('select[name="type_val"]');

//Если количество элементов или их атрибуты меняются - эту переменную заносим в вызов слушателя
const elements = document.querySelectorAll('input[name*="input_"], input[type="button"]');

function updateVisibility() {

    const selectedValue = typeSelect.value;

    elements.forEach(el => {
        if (el.name.includes('_' + selectedValue)) {  // из задания не понятно, нужно вхождение или нет. Вхождение - оставить это условие
        // if (el.name === 'input_' + selectedValue || el.name === 'button_' + selectedValue) { // точное совпадение - оставить это
            el.style.display = '';
            el.parentElement.style.display = '';
        } else {
            el.style.display = 'none';
            el.parentElement.style.display = 'none';
        }
    });
}


typeSelect.addEventListener('change', updateVisibility);

updateVisibility(); //инициализация. Вызываем после рендера страницы

/**
 * Если говорить об альтернативах - берем vue, значение селектора сохраняем в ref и через v-if рендерим
 * С одной стороны - больше накладные расходы на сам фреймворк и его цикл жизни, с другой стороны - раз сделали
 * компонент-обертку, который на основе свойства видимостью управляет и все - дальше он живет согласно правилам и сам управляет своей видимостью
 */
