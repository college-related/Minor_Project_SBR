
let vWheelers = document.querySelectorAll('.wheeler-radio');
let selectedWheeler = "2-wheeler"
let selectedVName = "Motorcycle"
let vNameDiv = document.querySelector('.name-div')
let engineCCSelect = document.querySelector('#eng-cc')
let publicRadio = document.querySelector('#public')
let privateRadio = document.querySelector('#private')
let publicLabel = document.querySelector('#public-label')
let vWheelerRadios = document.querySelectorAll('.tax-radio')
let vNames;

function addLabels(options, name)
{
    for(let i = 0; i < options.length; i++)
    {
        let newRadio = document.createElement('input')
        newRadio.type = 'radio'
        newRadio.name = 'v-name'
        newRadio.id = options[i].toLowerCase()
        newRadio.value = options[i]
        
        let newLabel = document.createElement('label')
        newLabel.innerHTML = options[i]
        newLabel.htmlFor = options[i].toLowerCase()
        newLabel.classList.add('tax-radio')
        newLabel.classList.add('tax-radio--vname')

        name.appendChild(newRadio)
        name.appendChild(newLabel)
    }
}

function addOptions(options, name){
    for(let j = 0; j < options.length; j++)
    {
        let newOption = document.createElement('option')
        newOption.value = options[j]
        newOption.innerHTML = options[j].toLowerCase()

        name.appendChild(newOption)
    }
}

function generateVNames() {
    vNameDiv.innerHTML = ""

    switch(selectedWheeler){
        case '2-wheeler':
            optArry = ["Motorcycle", "Scooter", "Moped"]
            addLabels(optArry, vNameDiv)
            break;
        case '3-wheeler':
            optArry = ["Tempo", "Auto-Rickshaw", "E-Rickshaw", "Three-Wheeler"]
            addLabels(optArry, vNameDiv)
            break;
        case '4-wheeler':
            optArry = ["Car", "Jeep", "Van", "MiniBus", "MiniTruck", 
                "Power-tiller", "MiniTipper", "Tractor"]
            addLabels(optArry, vNameDiv)
            break;
        case '6-wheeler':
            optArry = ["Truck", "Bus", "Fire-Brigade", "Tipper"]
            addLabels(optArry, vNameDiv)
            break;
        case '8-wheeler':
            optArry = ["Lorry", "Truck"]
            addLabels(optArry, vNameDiv)
            break;
    }
}

function generateEngCC()
{
    engineCCSelect.innerHTML = ""
    engineCCSelect.disabled = false
    engineCCSelect.classList.remove('disabled-radio')

    if(selectedVName == 'Motorcycle' || selectedVName == 'Scooter' || selectedVName == 'Moped'){
        optArry = ["0-125CC", "126CC-250CC", "251CC-400CC", "401CC-Greater"]
        addOptions(optArry, engineCCSelect)
    }else if(selectedVName == 'Car' || selectedVName == 'Jeep' || selectedVName == 'Van'){
        if(publicRadio.checked){
            optArry = ["0-1300CC", "1301CC-2000CC", "2001CC-2900CC", 
                "2901CC-4000CC", "4001CC-Greater"]
        }else{
            optArry = ["0-1000CC", "1001CC-1500CC", "15001CC-2000CC", "2001CC-2500CC",
                "2501CC-2900CC", "2901CC-Greater"]
        }
        addOptions(optArry, engineCCSelect)
    }else{
        engineCCSelect.disabled = true
        engineCCSelect.classList.add('disabled-radio')
    }
}

function enableDisablePP() {
    if(selectedWheeler == '2-wheeler'){
        privateRadio.setAttribute('checked', 'true')
        publicRadio.removeAttribute('checked')
        publicRadio.setAttribute('disabled', 'true')
        publicLabel.classList.add('disabled-radio')
    }else{
        publicRadio.removeAttribute('disabled')
        publicLabel.classList.remove('disabled-radio')
    }
}

for(let i = 0; i < 5; i++){
    vWheelerRadios[i].addEventListener('click', () => {
        selectedWheeler = vWheelers[i].value
        enableDisablePP()
        generateVNames()
        vNames = document.querySelectorAll('.tax-radio--vname')
        addListenerToNames()
    })
}

function addListenerToNames()
{
    for(let k = 0; k < vNames.length; k++){
        vNames[k].addEventListener('click', () => {
            selectedVName = vNames[k].previousElementSibling.value
            console.log(selectedVName)
            generateEngCC()
        })
    }
}