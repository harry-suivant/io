const checkCrm = document.getElementById('profil_commercial_crmUsed');
const nameCrm = document.getElementById('profil_commercial_crmName');
if (checkCrm) {
    checkCrm.addEventListener('change', () => {
        if (checkCrm.selectedIndex === 4) {
            nameCrm.className = 'form-control';
            nameCrm.required = true;
        }
        if (checkCrm.selectedIndex < 4) {
            nameCrm.className = 'invisible form-control';
        }
    });
}

const checkTimeOfProspec = document.getElementById('profil_commercial_timeOfProspec');
const precisTimeOfProspec = document.getElementById('profil_commercial_precisTimeOfProspec');

if (checkTimeOfProspec) {
    checkTimeOfProspec.addEventListener('change', () => {
        if (checkTimeOfProspec.selectedIndex === 4) {
            precisTimeOfProspec.className = 'form-control';
            precisTimeOfProspec.required = true;
        }
        if (checkTimeOfProspec.selectedIndex < 4) {
            precisTimeOfProspec.className = 'invisible form-control';
        }
    });
}

const checkNumberClosPerMonth = document.getElementById('profil_commercial_numberClosPerMonth');
const precisClosPerMonth = document.getElementById('profil_commercial_precisClosPerMonth');

if (checkNumberClosPerMonth) {
    checkNumberClosPerMonth.addEventListener('change', () => {
        if (checkNumberClosPerMonth.selectedIndex === 4) {
            precisClosPerMonth.className = 'form-control';
            precisClosPerMonth.required = true;
        }
        if (checkNumberClosPerMonth.selectedIndex < 4) {
            precisClosPerMonth.className = 'invisible form-control';
        }
    });
}

const checkBudOfProspPerMonth = document.getElementById('profil_commercial_budOfProspPerMonth');
const prcisBudProsMonth = document.getElementById('profil_commercial_prcisBudProsMonth');

if (checkBudOfProspPerMonth) {
    checkBudOfProspPerMonth.addEventListener('change', () => {
        if (checkBudOfProspPerMonth.selectedIndex === 6) {
            prcisBudProsMonth.className = 'form-control';
            prcisBudProsMonth.required = true;
        }
        if (checkBudOfProspPerMonth.selectedIndex < 6) {
            prcisBudProsMonth.className = 'invisible form-control';
        }
    });
}

const checkPriorityCommercial = document.getElementById('profil_commercial_priorityCommercial_5');
const prcisPrioCommercial = document.getElementById('profil_commercial_prcisPrioCommercial');

if (checkPriorityCommercial) {
    checkPriorityCommercial.addEventListener('change', () => {
        if (checkPriorityCommercial.checked) {
            prcisPrioCommercial.className = 'form-control';
            prcisPrioCommercial.required = true;
        }
        if (checkPriorityCommercial.checked === false) {
            prcisPrioCommercial.className = 'invisible form-control';
        }
    });
}
