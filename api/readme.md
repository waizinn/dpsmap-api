API Documentation

URL:https://dps.ethicaldigit.com/api/ (HTTP Method: POST OR GET)

    Search by keyword
        Request: 
        token=your_token,
        value=text what the user want to search (minimum 3 characters)
        
        Example Request with GET Method :
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&value=1st%20street

    Search by DPS ID
        Request: 
        token=your_token,
        dps_id=DPS ID
        
        Example Request with GET Method :
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&dps_id=DAPT0020001

    Search by Latitude & Longitude (find the nearest points)
        Request: 
        token=your_token,
        lat=Latitude,
        lon=Longitude
        
        Example Request with GET Method : 
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&lon=96.083618&lat=16.877551

    
    Search by Dist_N_Eng to get all township list
        Request: 
        token=your_token,
        filter=tsp
        value=the value of Dist_N_Eng (Example: Yangon East District)
        
        Example Request with GET Method :
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&filter=tsp&value=Yangon%20East%20District


    Search by Tsp_N_Eng to get all ward list
        Request: 
        token=your_token,
        filter=ward
        value=the value of Tsp_N_Eng (Example: Dawbon)
        
        Example Request with GET Method :
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&filter=ward&value=Dawbon



        Example Response  (JSON): 
        {
        "code": 200,
        "message": "Ok",
        "data": [
        {
            "DPS_ID": "G_AP0045446",
            "HN_Eng": "10",
            "HN_Myn": "၁၀",
            "Postal_Cod": "11411",
            "St_N_Eng": "Aung Chan Thar Street",
            "St_N_Myn": "အောင်ချမ်းသာလမ်း",
            "Ward_N_Eng": "Ward-3",
            "Ward_N_Myn": "(၃)ရပ်ကွက်",
            "Tsp_N_Eng": "Hlaingtharya",
            "Tsp_N_Myn": "လှိုင်သာယာ",
            "Dist_N_Eng": "Yangon North District",
            "Dist_N_Myn": "ရန်ကုန်မြောက်ပိုင်းခရိုင်",
            "S_R_N_Eng": "Yangon Region",
            "S_R_N_Myn": "ရန်ကုန်တိုင်းဒေသကြီး",
            "Country_N": "Myanmar",
            "Longitude": "96.083618",
            "Latitude": "16.877551"
        },
        {
            "DPS_ID": "G_AP0083405",
            "HN_Eng": "109",
            "HN_Myn": "၁၀၉",
            "Postal_Cod": "11401",
            "St_N_Eng": "Aung Chan Thar Street",
            "St_N_Myn": "အောင်ချမ်းသာလမ်း",
            "Ward_N_Eng": "Ward-6",
            "Ward_N_Myn": "(၆)ရပ်ကွက်",
            "Tsp_N_Eng": "Hlaingtharya",
            "Tsp_N_Myn": "လှိုင်သာယာ",
            "Dist_N_Eng": "Yangon North District",
            "Dist_N_Myn": "ရန်ကုန်မြောက်ပိုင်းခရိုင်",
            "S_R_N_Eng": "Yangon Region",
            "S_R_N_Myn": "ရန်ကုန်တိုင်းဒေသကြီး",
            "Country_N": "Myanmar",
            "Longitude": "96.057003",
            "Latitude": "16.865725"
        }
                ]
        }




    
    Response for Not Found
        {
        "code": 404,
        "message": "Not Found"
        }

    Response  for Unauthorized Access
        {
        "code": 401,
        "message": "Unauthorized!"
        }

