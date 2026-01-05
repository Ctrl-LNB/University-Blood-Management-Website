const donorForm = document.getElementById('donor-form');
const donorInfoCard = document.getElementById('donor-info-card');
const selectedGroup = document.getElementById('blood');

const getData = async () => {
  const res = await fetch('php/find_donor.php');
  const json = await res.json();
  return json;
}

const showData = async (group) => {
  const data = await getData();
  const searchingData = data.filter(donor => donor.BLOOD_GROUP === group);
  let donorList = "";

  if (!searchingData.length) {
    donorList += `
      <div style="border: 2px solid #e0a0a0; 
        background-color: #fff8f8; 
        border-radius: 10px; padding: 15px; 
        text-align: center; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
        max-width: 300px; 
        margin: 20px auto;">
        <h3 style="color: #b33; margin-bottom: 10px;">Donor not found</h3>
        <p style="color: #555; font-size: 14px; margin-bottom: 10px;">
          We couldn't find any matching donor record.
        </p>
        <a href="be_donor.html" 
           style="display: inline-block; padding: 6px 12px; 
           background-color: #b33; color: white; 
           text-decoration: none; border-radius: 5px; 
           border: 1px solid #7a0f0f;">
           Be a Donor
        </a>
      </div>

      <div style="border: 2px solid #e0a0a0; 
        background-color: #fff8f8; 
        border-radius: 10px; padding: 15px; 
        text-align: center; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
        max-width: 300px; 
        margin: 20px auto;">
        <h3 style="color: #b33; margin-bottom: 10px;">Member not found</h3>
        <p style="color: #555; font-size: 14px; margin-bottom: 10px;">
          We couldn't find any matching membership record.
        </p>
        <a href="membership.html" 
           style="display: inline-block; padding: 6px 12px; 
           background-color: #b33; color: white; 
           text-decoration: none; border-radius: 5px; 
           border: 1px solid #7a0f0f;">
           Be a Member
        </a>
      </div>
    `;
    donorInfoCard.innerHTML = donorList;
    return;
  }

  // -------- SHOW DONOR / MEMBER CARDS --------
  searchingData.forEach(element => {

    const donorIcon = `
      <span style="display:inline-block; position:relative; margin-right:6px;">
        <i class="fa-solid fa-droplet" style="color:#c70000;"></i>
        <i class="fa-solid fa-plus" 
           style="color:white; font-size:10px; position:absolute; top:4px; left:7px;"></i>
      </span>
    `;


    const memberIcon = `   
     <i class="fa-solid fa-circle-check" style="color:#1DA1F2; margin-left:6px;"></i>
     <span style="display:inline-block; position:relative; margin-right:6px;">
        <i class="fa-solid fa-droplet" style="color:#c70000;"></i>
        <i class="fa-solid fa-plus" 
           style="color:white; font-size:10px; position:absolute; top:4px; left:7px;"></i>
      </span>
    `;

    const iconToShow = element.TYPE === 'Member' ? memberIcon : donorIcon;

    donorList += `
      <div class="donor-card" 
           style="border: 2px solid #ccc; padding: 15px; 
           border-radius: 10px; margin: 10px; 
           box-shadow: 0 2px 6px rgba(0,0,0,0.1); 
           background-color: #fafafa;">

        <h3 style="color:#333;">
          ${iconToShow}
          Name: ${element.FULL_NAME}
        </h3>

        <p style="color:#555;">Blood Group: ${element.BLOOD_GROUP}</p>
        <p style="color:#555;">Phone: ${element.PHONE_NUMBER}</p>
        <p style="color:#555;">Address: ${element.ADDRESS}</p>
        <p style="color:#555;">Last Donate: ${element.LAST_DONATION_DATE}</p>
      </div>
    `;
  });

  donorInfoCard.innerHTML = donorList;
};


donorForm.addEventListener('submit', (e) => {
  e.preventDefault();
  showData(selectedGroup.value);
  donorInfoCard.style.display = 'grid';
});
