const checkMarketingOui = document.getElementById('profil_poleMarketing_0');
const checkMarketingNon = document.getElementById('profil_poleMarketing_1');
const numberMarketingCheck = document.getElementById('profil_numberMarketers');

if (checkMarketingOui) {
    checkMarketingOui.addEventListener('change', () => {
        if (checkMarketingOui.checked) {
            numberMarketingCheck.className = 'form-control';
            numberMarketingCheck.required = true;
        }
    });

    checkMarketingNon.addEventListener('change', () => {
        if (checkMarketingNon.checked) {
            numberMarketingCheck.className = 'invisible form-control';
            numberMarketingCheck.required = false;
        }
    });
}

const checkCommercialOui = document.getElementById('profil_poleCommercial_0');
const checkCommercialNon = document.getElementById('profil_poleCommercial_1');
const numberCommercialCheck = document.getElementById('profil_numberCommercial');

if (checkCommercialOui) {
    checkCommercialOui.addEventListener('change', () => {
        if (checkCommercialOui.checked) {
            numberCommercialCheck.className = 'form-control';
            numberCommercialCheck.required = true;
        }
    });

    checkCommercialNon.addEventListener('change', () => {
        if (checkCommercialNon.checked) {
            numberCommercialCheck.className = 'invisible form-control';
            numberCommercialCheck.required = false;
        }
    });
}
