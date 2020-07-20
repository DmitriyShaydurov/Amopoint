
function hideInputs(type, inputFields)
{
    showInputs();
    for (var i = 0; i < inputFields.length; i++) {
        if (inputFields[i].type === "text" && inputFields[i].getAttribute("name").replace("input_", "") !== getType(type)) {
            inputFields[i].setAttribute("style", "visibility: hidden;");
        }
    }
}

function showInputs()
{
    for (var i = 0; i < inputFields.length; i++) {
            inputFields[i].setAttribute("style", "visibility: visible;");
    }
}

function getType(type)
{
    return type.options[type.selectedIndex].text;
}

let inputFields = document.getElementsByTagName('input');
let type =  document.getElementsByTagName('select')[0];

type.addEventListener("change", function(){hideInputs(type, inputFields)});
window.onload = hideInputs(type, inputFields);



