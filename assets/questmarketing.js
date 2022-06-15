const checkSocialNetworkUsed = document.getElementById('profil_marketing_socialNetworkUsed_9');
const prcSocialNetworkUse = document.getElementById('profil_marketing_prcSocialNetworkUse');

if (checkSocialNetworkUsed) {
    checkSocialNetworkUsed.addEventListener('change', () => {
        if (checkSocialNetworkUsed.checked) {
            prcSocialNetworkUse.className = 'form-control';
            prcSocialNetworkUse.required = true;
        }
        if (checkSocialNetworkUsed.checked === false) {
            prcSocialNetworkUse.className = 'invisible form-control';
        }
    });
}

const checkSocialNetworkEngage = document.getElementById('profil_marketing_socialNetworkEngage_9');
const prcSocialNetworkEn = document.getElementById('profil_marketing_prcSocialNetworkEn');

if (checkSocialNetworkEngage) {
    checkSocialNetworkEngage.addEventListener('change', () => {
        if (checkSocialNetworkEngage.checked) {
            prcSocialNetworkEn.className = 'form-control';
            prcSocialNetworkEn.required = true;
        }
        if (checkSocialNetworkEngage.checked === false) {
            prcSocialNetworkEn.className = 'invisible form-control';
        }
    });
}

const checkActionSeaMep = document.getElementById('profil_marketing_actionSeaMep_5');
const prcActionSeaMep = document.getElementById('profil_marketing_prcActionSeaMep');

if (checkActionSeaMep) {
    checkActionSeaMep.addEventListener('change', () => {
        if (checkActionSeaMep.checked) {
            prcActionSeaMep.className = 'form-control';
            prcActionSeaMep.required = true;
        }
        if (checkActionSeaMep.checked === false) {
            prcActionSeaMep.className = 'invisible form-control';
        }
    });
}

const checkActionSeoMep = document.getElementById('profil_marketing_actionSeoMep_4');
const prcActionSeoMep = document.getElementById('profil_marketing_prcActionSeoMep');

if (checkActionSeoMep) {
    checkActionSeoMep.addEventListener('change', () => {
        if (checkActionSeoMep.checked) {
            prcActionSeoMep.className = 'form-control';
        }
        if (checkActionSeoMep.checked === false) {
            prcActionSeoMep.className = 'invisible form-control';
            prcActionSeaMep.required = true;
        }
    });
}

const checkSocialNetworkBestRoi = document.getElementById('profil_marketing_socialNetworkBestRoi_9');
const prcSNBestRoi = document.getElementById('profil_marketing_prcSNBestRoi');

if (checkSocialNetworkBestRoi) {
    checkSocialNetworkBestRoi.addEventListener('change', () => {
        if (checkSocialNetworkBestRoi.checked) {
            prcSNBestRoi.className = 'form-control';
            prcSNBestRoi.required = true;
        }
        if (checkSocialNetworkBestRoi.checked === false) {
            prcSNBestRoi.className = 'invisible form-control';
        }
    });
}

const checkVectorMarketing = document.getElementById('profil_marketing_vectorMarketing_5');
const prcVectorMarketing = document.getElementById('profil_marketing_prcVectorMarketing');

if (checkVectorMarketing) {
    checkVectorMarketing.addEventListener('change', () => {
        if (checkVectorMarketing.checked) {
            prcVectorMarketing.className = 'form-control';
            prcVectorMarketing.required = true;
        }
        if (checkVectorMarketing.checked === false) {
            prcVectorMarketing.className = 'invisible form-control';
        }
    });
}

const checkPriorityMarketing = document.getElementById('profil_marketing_priorityMarketing_5');
const prcPriorityMarketing = document.getElementById('profil_marketing_prcPriorityMarketing');

if (checkPriorityMarketing) {
    checkPriorityMarketing.addEventListener('change', () => {
        if (checkPriorityMarketing.checked) {
            prcPriorityMarketing.className = 'form-control';
            prcPriorityMarketing.required = true;
        }
        if (checkPriorityMarketing.checked === false) {
            prcPriorityMarketing.className = 'invisible form-control';
        }
    });
}
