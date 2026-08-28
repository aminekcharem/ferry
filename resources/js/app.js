const carCatalog = {
    Acura: ['ILX', 'Integra', 'MDX', 'NSX', 'RDX', 'RLX', 'TLX', 'TSX'],
    Abarth: ['124 Spider', '500', '500C', '595', '695', 'Grande Punto', 'Punto', 'Punto Evo'],
    'Alfa Romeo': ['145', '147', '156', '159', '166', '4C', 'Brera', 'Giulia', 'Giulietta', 'GT', 'MiTo', 'Spider', 'Stelvio', 'Tonale'],
    Alpina: ['B3', 'B4', 'B5', 'B7', 'D3', 'D4', 'XD3'],
    'Aston Martin': ['DB9', 'DB11', 'DB12', 'DBS', 'DBX', 'Rapide', 'Vanquish', 'Vantage', 'Virage'],
    Audi: ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'Q2', 'Q3', 'Q4 e-tron', 'Q5', 'Q7', 'Q8', 'R8', 'TT', 'e-tron'],
    BAIC: ['Beijing X3', 'Beijing X5', 'Beijing X7', 'BJ40', 'D20', 'Senova'],
    Bentley: ['Arnage', 'Bentayga', 'Continental GT', 'Continental GTC', 'Flying Spur', 'Mulsanne'],
    BMW: ['1 Series', '2 Series', '3 Series', '4 Series', '5 Series', '6 Series', '7 Series', '8 Series', 'i3', 'i4', 'iX', 'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7', 'Z4'],
    Brilliance: ['FRV', 'H220', 'H230', 'H330', 'V3', 'V5'],
    BYD: ['Atto 3', 'Dolphin', 'Han', 'Seal', 'Seal U', 'Seagull', 'Song Plus', 'Tang', 'Yuan Plus'],
    Cadillac: ['ATS', 'CT4', 'CT5', 'CTS', 'Escalade', 'SRX', 'XT4', 'XT5', 'XT6'],
    Changan: ['Alsvin', 'CS15', 'CS35', 'CS55', 'CS75', 'Eado', 'Hunter', 'Uni-K', 'Uni-T'],
    Chery: ['Arrizo 5', 'Arrizo 6', 'Arrizo 8', 'Tiggo 2', 'Tiggo 3', 'Tiggo 4', 'Tiggo 7', 'Tiggo 8'],
    Chevrolet: ['Aveo', 'Blazer', 'Camaro', 'Captiva', 'Corvette', 'Cruze', 'Equinox', 'Lacetti', 'Malibu', 'Orlando', 'Silverado', 'Spark', 'Tahoe', 'Trailblazer', 'Trax'],
    Chrysler: ['200', '300', 'Grand Voyager', 'Pacifica', 'PT Cruiser', 'Sebring', 'Town & Country', 'Voyager'],
    Citroen: ['C1', 'C2', 'C3', 'C3 Aircross', 'C4', 'C4 Cactus', 'C4 Picasso', 'C5', 'C5 Aircross', 'Berlingo', 'Jumpy', 'Saxo', 'Xsara', 'Xsara Picasso'],
    Cupra: ['Ateca', 'Born', 'Formentor', 'Leon', 'Tavascan', 'Terramar'],
    Dacia: ['Dokker', 'Duster', 'Jogger', 'Lodgy', 'Logan', 'Logan MCV', 'Sandero', 'Sandero Stepway', 'Spring'],
    Daewoo: ['Kalos', 'Lacetti', 'Lanos', 'Leganza', 'Matiz', 'Nexia', 'Nubira', 'Tacuma'],
    Daihatsu: ['Charade', 'Copen', 'Cuore', 'Materia', 'Move', 'Sirion', 'Terios', 'YRV'],
    Dodge: ['Avenger', 'Caliber', 'Challenger', 'Charger', 'Dakota', 'Durango', 'Journey', 'Nitro', 'Ram'],
    DS: ['DS 3', 'DS 3 Crossback', 'DS 4', 'DS 5', 'DS 7', 'DS 7 Crossback', 'DS 9'],
    Ferrari: ['296', '458', '488', '599', '812', 'California', 'F12', 'F8', 'Portofino', 'Purosangue', 'Roma', 'SF90'],
    Fiat: ['124 Spider', '500', '500C', '500L', '500X', 'Bravo', 'Doblo', 'Ducato', 'Fiorino', 'Freemont', 'Grande Punto', 'Panda', 'Punto', 'Qubo', 'Scudo', 'Sedici', 'Tipo'],
    Fisker: ['Karma', 'Ocean', 'Pear'],
    Ford: ['B-Max', 'C-Max', 'EcoSport', 'Edge', 'Escape', 'Explorer', 'Fiesta', 'Focus', 'Fusion', 'Galaxy', 'Kuga', 'Mondeo', 'Mustang', 'Puma', 'Ranger', 'S-Max', 'Tourneo', 'Transit'],
    Forthing: ['Friday', 'T5', 'T5 Evo', 'U-Tour'],
    GAC: ['Emkoo', 'Emzoom', 'GA4', 'GS3', 'GS4', 'GS5', 'GS8', 'M8'],
    Geely: ['Atlas', 'Azkarra', 'Coolray', 'Emgrand', 'Geometry C', 'Monjaro', 'Okavango', 'Tugella'],
    Genesis: ['G70', 'G80', 'G90', 'GV60', 'GV70', 'GV80'],
    'Great Wall': ['C30', 'Haval H3', 'Haval H5', 'Poer', 'Wingle 5', 'Wingle 7'],
    GMC: ['Acadia', 'Canyon', 'Envoy', 'Savana', 'Sierra', 'Terrain', 'Yukon'],
    Haval: ['Dargo', 'H2', 'H6', 'H7', 'H9', 'Jolion'],
    Honda: ['Accord', 'City', 'Civic', 'CR-V', 'CR-Z', 'e', 'FR-V', 'HR-V', 'Insight', 'Jazz', 'Legend', 'Odyssey', 'Pilot', 'Prelude', 'S2000'],
    Hummer: ['H1', 'H2', 'H3', 'EV'],
    Hyundai: ['Accent', 'Atos', 'Bayon', 'Coupe', 'Elantra', 'Getz', 'i10', 'i20', 'i30', 'i40', 'Ioniq', 'Ioniq 5', 'Ioniq 6', 'Kona', 'Matrix', 'Santa Fe', 'Sonata', 'Tucson', 'Veloster'],
    Infiniti: ['EX', 'FX', 'G', 'M', 'Q30', 'Q50', 'Q60', 'Q70', 'QX30', 'QX50', 'QX60', 'QX70', 'QX80'],
    Isuzu: ['D-Max', 'MU-X', 'Trooper'],
    Jaguar: ['E-Pace', 'F-Pace', 'F-Type', 'I-Pace', 'S-Type', 'XE', 'XF', 'XJ', 'XK'],
    Jeep: ['Cherokee', 'Commander', 'Compass', 'Grand Cherokee', 'Gladiator', 'Patriot', 'Renegade', 'Wrangler'],
    Kia: ['Carens', 'Carnival', 'Ceed', 'Cerato', 'EV6', 'EV9', 'Niro', 'Optima', 'Picanto', 'ProCeed', 'Rio', 'Sorento', 'Soul', 'Sportage', 'Stinger', 'Stonic', 'XCeed'],
    Lamborghini: ['Aventador', 'Gallardo', 'Huracan', 'Murcielago', 'Revuelto', 'Urus'],
    Lada: ['4x4', 'Granta', 'Kalina', 'Largus', 'Niva', 'Priora', 'Vesta', 'XRAY'],
    Lancia: ['Delta', 'Musa', 'Phedra', 'Thema', 'Thesis', 'Voyager', 'Ypsilon'],
    'Land Rover': ['Defender', 'Discovery', 'Discovery Sport', 'Freelander', 'Range Rover', 'Range Rover Evoque', 'Range Rover Sport', 'Range Rover Velar'],
    Leapmotor: ['C01', 'C10', 'C11', 'T03'],
    Lexus: ['CT', 'ES', 'GS', 'IS', 'LBX', 'LS', 'NX', 'RC', 'RX', 'UX'],
    Lincoln: ['Aviator', 'Continental', 'Corsair', 'MKC', 'MKS', 'MKX', 'MKZ', 'Navigator', 'Nautilus'],
    Lucid: ['Air', 'Gravity'],
    Maserati: ['3200 GT', 'Ghibli', 'GranTurismo', 'Grecale', 'Levante', 'MC20', 'Quattroporte', 'Spyder'],
    Mazda: ['2', '3', '5', '6', 'CX-3', 'CX-30', 'CX-5', 'CX-7', 'CX-9', 'CX-60', 'MX-30', 'MX-5', 'RX-8'],
    'Mercedes-Benz': ['A-Class', 'B-Class', 'C-Class', 'CLA', 'CLS', 'E-Class', 'G-Class', 'GLA', 'GLB', 'GLC', 'GLE', 'GLS', 'M-Class', 'S-Class', 'SL', 'SLC', 'Sprinter', 'V-Class', 'Viano', 'Vito'],
    MG: ['3', '4', '5', '6', 'EHS', 'HS', 'Marvel R', 'MGF', 'TF', 'ZS', 'ZS EV'],
    Mini: ['Clubman', 'Convertible', 'Cooper', 'Countryman', 'Coupe', 'Paceman', 'Roadster'],
    Mitsubishi: ['ASX', 'Colt', 'Eclipse Cross', 'Grandis', 'L200', 'Lancer', 'Montero', 'Outlander', 'Pajero', 'Space Star'],
    Nissan: ['370Z', 'Almera', 'Ariya', 'Juke', 'Leaf', 'Micra', 'Murano', 'Navara', 'Note', 'Pathfinder', 'Patrol', 'Primera', 'Qashqai', 'Terrano', 'X-Trail'],
    Opel: ['Adam', 'Agila', 'Antara', 'Astra', 'Combo', 'Corsa', 'Crossland', 'Grandland', 'Insignia', 'Meriva', 'Mokka', 'Signum', 'Tigra', 'Vectra', 'Vivaro', 'Zafira'],
    Polestar: ['1', '2', '3', '4'],
    Peugeot: ['106', '107', '108', '2008', '206', '207', '208', '3008', '301', '307', '308', '4007', '5008', '508', 'Partner', 'RCZ', 'Rifter', 'Traveller'],
    Porsche: ['718 Boxster', '718 Cayman', '911', 'Cayenne', 'Macan', 'Panamera', 'Taycan'],
    Proton: ['Exora', 'Gen-2', 'Iriz', 'Persona', 'Saga', 'X50', 'X70'],
    Ram: ['1500', '2500', '3500', 'ProMaster'],
    Renault: ['Arkana', 'Austral', 'Captur', 'Clio', 'Espace', 'Fluence', 'Kadjar', 'Kangoo', 'Koleos', 'Laguna', 'Megane', 'Modus', 'Scenic', 'Talisman', 'Trafic', 'Twingo', 'Zoe'],
    Rivian: ['R1S', 'R1T'],
    'Rolls-Royce': ['Cullinan', 'Dawn', 'Ghost', 'Phantom', 'Spectre', 'Wraith'],
    Rover: ['25', '45', '75', 'Streetwise'],
    Saab: ['9-3', '9-5', '900', '9000'],
    Seat: ['Alhambra', 'Altea', 'Arona', 'Ateca', 'Cordoba', 'Exeo', 'Ibiza', 'Leon', 'Mii', 'Tarraco', 'Toledo'],
    Seres: ['3', '5', '7'],
    Skoda: ['Citigo', 'Enyaq', 'Fabia', 'Kamiq', 'Karoq', 'Kodiaq', 'Octavia', 'Rapid', 'Roomster', 'Scala', 'Superb', 'Yeti'],
    Smart: ['#1', '#3', 'Forfour', 'Fortwo', 'Roadster'],
    SsangYong: ['Actyon', 'Korando', 'Kyron', 'Musso', 'Rexton', 'Rodius', 'Tivoli', 'XLV'],
    Subaru: ['BRZ', 'Forester', 'Impreza', 'Justy', 'Legacy', 'Levorg', 'Outback', 'Tribeca', 'WRX', 'XV'],
    Suzuki: ['Alto', 'Baleno', 'Celerio', 'Grand Vitara', 'Ignis', 'Jimny', 'Kizashi', 'S-Cross', 'Splash', 'Swift', 'SX4', 'Vitara', 'Wagon R'],
    Tesla: ['Cybertruck', 'Model 3', 'Model S', 'Model X', 'Model Y', 'Roadster'],
    Toyota: ['Auris', 'Avensis', 'Aygo', 'bZ4X', 'C-HR', 'Camry', 'Corolla', 'Corolla Cross', 'GT86', 'Highlander', 'Hilux', 'Land Cruiser', 'Prius', 'Proace', 'RAV4', 'Supra', 'Urban Cruiser', 'Verso', 'Yaris', 'Yaris Cross'],
    VinFast: ['VF 3', 'VF 5', 'VF 6', 'VF 7', 'VF 8', 'VF 9'],
    Volkswagen: ['Amarok', 'Arteon', 'Beetle', 'Caddy', 'CC', 'Crafter', 'Golf', 'Golf 1', 'Golf 2', 'Golf 3', 'Golf 4', 'Golf 5', 'Golf 6', 'Golf 7', 'Golf 8', 'Golf Cabriolet', 'Golf GTD', 'Golf GTE', 'Golf GTI', 'Golf Plus', 'Golf R', 'Golf Sportsvan', 'Golf Variant', 'ID.3', 'ID.4', 'Jetta', 'Multivan', 'Passat', 'Polo', 'Scirocco', 'Sharan', 'T-Cross', 'T-Roc', 'Taigo', 'Tiguan', 'Touareg', 'Touran', 'Transporter', 'Up'],
    Volvo: ['C30', 'C40', 'S40', 'S60', 'S80', 'S90', 'V40', 'V50', 'V60', 'V70', 'V90', 'XC40', 'XC60', 'XC70', 'XC90'],
    Wey: ['Coffee 01', 'Coffee 02', 'Mocha', 'Tank 300', 'Tank 500'],
    Xpeng: ['G3', 'G6', 'G9', 'P5', 'P7'],
    Zeekr: ['001', '007', '009', 'X'],
};

const carCatalogDetailedModels = {
    Acura: ['Integra Type S', 'MDX Type S', 'RDX A-Spec', 'TLX Type S'],
    Abarth: ['500 Esseesse', '595 Competizione', '595 Turismo', '695 Biposto', '695 Competizione'],
    'Alfa Romeo': ['147 GTA', '156 GTA', '159 Sportwagon', 'Giulia Quadrifoglio', 'Giulietta Sprint', 'Stelvio Quadrifoglio', 'Tonale Plug-in Hybrid'],
    Alpina: ['B3 Touring', 'B4 Gran Coupe', 'B5 Touring', 'D3 Touring', 'XD3 Allrad'],
    'Aston Martin': ['DB11 Volante', 'DB12 Volante', 'DBS Superleggera', 'DBX 707', 'Vantage Roadster'],
    Audi: ['A1 Sportback', 'A3 Sportback', 'A3 Sedan', 'A4 Avant', 'A5 Sportback', 'A6 Avant', 'A7 Sportback', 'Q3 Sportback', 'Q4 Sportback e-tron', 'RS3', 'RS4 Avant', 'RS5', 'RS6 Avant', 'RS7', 'S3', 'S4', 'S5', 'SQ5', 'TT Roadster'],
    BAIC: ['Beijing X3 Pro', 'Beijing X5 Plus', 'Beijing X7 Premium', 'BJ40 Plus', 'Senova D50'],
    Bentley: ['Bentayga EWB', 'Bentayga Hybrid', 'Continental GT Speed', 'Continental GTC Speed', 'Flying Spur Hybrid'],
    BMW: ['1 Series F20', '1 Series F40', '2 Series Active Tourer', '2 Series Gran Coupe', '3 Series E46', '3 Series E90', '3 Series F30', '3 Series G20', '3 Series Touring', '4 Series Gran Coupe', '5 Series E60', '5 Series F10', '5 Series G30', '5 Series Touring', '7 Series G11', 'M2', 'M3', 'M4', 'M5', 'X1 xDrive', 'X3 xDrive', 'X5 xDrive', 'X6 xDrive'],
    Brilliance: ['FRV Cross', 'H220 Cross', 'H230 Sedan', 'H330 Sedan', 'V3 Comfort', 'V5 Deluxe'],
    BYD: ['Atto 3 Comfort', 'Atto 3 Design', 'Dolphin Comfort', 'Dolphin Design', 'Han EV', 'Seal Design', 'Seal Excellence', 'Tang EV'],
    Cadillac: ['CTS Coupe', 'Escalade ESV', 'Escalade Sport', 'XT4 Premium Luxury', 'XT5 Premium Luxury', 'XT6 Sport'],
    Changan: ['Alsvin Comfort', 'Alsvin Lumiere', 'CS35 Plus', 'CS55 Plus', 'CS75 Plus', 'Uni-K iDD', 'Uni-T Sport'],
    Chery: ['Arrizo 5 Pro', 'Arrizo 6 Pro', 'Tiggo 4 Pro', 'Tiggo 7 Pro', 'Tiggo 8 Pro', 'Tiggo 8 Pro Max'],
    Chevrolet: ['Aveo Sedan', 'Camaro SS', 'Captiva LT', 'Corvette Stingray', 'Cruze Hatchback', 'Cruze Sedan', 'Spark LT', 'Tahoe Z71', 'Trailblazer LT'],
    Chrysler: ['300C', 'Pacifica Hybrid', 'PT Cruiser Cabriolet', 'Voyager LX'],
    Citroen: ['C3 Picasso', 'C3 You', 'C4 Aircross', 'C4 Grand Picasso', 'C5 X', 'Berlingo Multispace', 'Jumpy Combi', 'Xsara Break'],
    Cupra: ['Ateca VZ', 'Born VZ', 'Formentor VZ', 'Leon Sportstourer', 'Leon VZ', 'Tavascan VZ'],
    Dacia: ['Duster 4x4', 'Duster Stepway', 'Logan Stepway', 'Sandero Essential', 'Sandero Stepway Extreme', 'Spring Electric'],
    Daewoo: ['Kalos Sedan', 'Lacetti Hatchback', 'Lanos Sedan', 'Matiz SE', 'Nubira Wagon'],
    Daihatsu: ['Charade GTti', 'Copen Roadster', 'Cuore Avanzato', 'Sirion 4Track', 'Terios 4WD'],
    Dodge: ['Challenger SRT', 'Charger SRT', 'Durango R/T', 'Journey Crossroad', 'Ram 1500'],
    DS: ['DS 3 E-Tense', 'DS 4 Cross', 'DS 7 E-Tense', 'DS 9 E-Tense'],
    Ferrari: ['296 GTB', '296 GTS', '458 Italia', '488 GTB', '812 Superfast', 'California T', 'F8 Tributo', 'SF90 Stradale'],
    Fiat: ['500 Abarth', '500 Hybrid', '500L Living', '500X Cross', 'Doblo Cargo', 'Ducato Maxi', 'Grande Punto Evo', 'Panda 4x4', 'Tipo Cross'],
    Fisker: ['Ocean Extreme', 'Ocean Sport', 'Ocean Ultra'],
    Ford: ['Fiesta Mk6', 'Fiesta Mk7', 'Fiesta ST', 'Focus Mk2', 'Focus Mk3', 'Focus Mk4', 'Focus ST', 'Focus Wagon', 'Kuga Hybrid', 'Mondeo Wagon', 'Mustang GT', 'Puma ST', 'Ranger Raptor', 'Transit Custom'],
    Forthing: ['T5 Comfort', 'T5 Evo Heat', 'T5 Evo Premium', 'U-Tour Luxury'],
    GAC: ['Emkoo Hybrid', 'Emzoom R-Style', 'GA4 Plus', 'GS3 Emzoom', 'GS4 Plus', 'GS8 Traveller', 'M8 Master'],
    Geely: ['Atlas Pro', 'Coolray Comfort', 'Coolray Flagship', 'Emgrand GS', 'Monjaro Exclusive', 'Okavango Plus'],
    Genesis: ['G70 Shooting Brake', 'G80 Electrified', 'GV60 Performance', 'GV70 Electrified', 'GV80 Coupe'],
    'Great Wall': ['C30 Sedan', 'Poer Commercial', 'Poer Passenger', 'Wingle 5 Diesel', 'Wingle 7 Diesel'],
    GMC: ['Acadia Denali', 'Canyon AT4', 'Savana Cargo', 'Sierra Denali', 'Terrain Denali', 'Yukon XL'],
    Haval: ['Dargo X', 'H2 Jolion', 'H6 Hybrid', 'H6 GT', 'H9 4WD', 'Jolion Hybrid'],
    Honda: ['Accord Tourer', 'Civic 8', 'Civic 9', 'Civic 10', 'Civic 11', 'Civic Type R', 'CR-V Hybrid', 'HR-V e:HEV', 'Jazz Hybrid', 'Pilot Touring'],
    Hummer: ['H1 Alpha', 'H2 SUT', 'H3T', 'EV SUV', 'EV Pickup'],
    Hyundai: ['Accent Sedan', 'Elantra Hybrid', 'Getz Cross', 'i10 N Line', 'i20 Active', 'i20 N', 'i30 Fastback', 'i30 N', 'Kona Electric', 'Santa Fe Hybrid', 'Tucson Hybrid', 'Veloster N'],
    Infiniti: ['FX35', 'FX37', 'FX50', 'G35', 'G37', 'Q50 Hybrid', 'Q60 Coupe', 'QX60 Hybrid', 'QX80 Luxe'],
    Isuzu: ['D-Max Crew Cab', 'D-Max Space Cab', 'D-Max X-Terrain', 'MU-X 4WD'],
    Jaguar: ['E-Pace R-Dynamic', 'F-Pace SVR', 'F-Type Coupe', 'F-Type Convertible', 'I-Pace EV400', 'XF Sportbrake', 'XJ L'],
    Jeep: ['Cherokee Trailhawk', 'Compass 4xe', 'Grand Cherokee L', 'Grand Cherokee Trackhawk', 'Renegade 4xe', 'Wrangler Rubicon', 'Wrangler Sahara'],
    Kia: ['Ceed Sportswagon', 'EV6 GT', 'Niro Hybrid', 'Niro EV', 'Picanto GT-Line', 'ProCeed GT', 'Rio Sedan', 'Sorento Hybrid', 'Sportage Hybrid', 'Stinger GT', 'XCeed Plug-in Hybrid'],
    Lamborghini: ['Aventador SVJ', 'Gallardo Spyder', 'Huracan Evo', 'Huracan Spyder', 'Revuelto V12', 'Urus Performante'],
    Lada: ['4x4 Urban', 'Granta Liftback', 'Largus Cross', 'Niva Legend', 'Niva Travel', 'Vesta Cross', 'Vesta SW'],
    Lancia: ['Delta Integrale', 'Musa Platino', 'Thema Executive', 'Voyager Platinum', 'Ypsilon Hybrid'],
    'Land Rover': ['Defender 90', 'Defender 110', 'Defender 130', 'Discovery HSE', 'Freelander 2', 'Range Rover Autobiography', 'Range Rover Evoque Convertible', 'Range Rover Sport HSE', 'Range Rover Velar R-Dynamic'],
    Leapmotor: ['C01 Extended Range', 'C10 EV', 'C11 Extended Range', 'T03 Comfort'],
    Lexus: ['CT 200h', 'ES 300h', 'GS 450h', 'IS 300h', 'LBX Hybrid', 'LS 500h', 'NX 300h', 'NX 450h+', 'RX 350h', 'RX 450h', 'UX 250h'],
    Lincoln: ['Aviator Grand Touring', 'Corsair Grand Touring', 'MKC Reserve', 'MKZ Hybrid', 'Navigator L', 'Nautilus Reserve'],
    Lucid: ['Air Grand Touring', 'Air Pure', 'Air Sapphire', 'Air Touring', 'Gravity Touring'],
    Maserati: ['Ghibli Hybrid', 'Grecale Folgore', 'GranTurismo Folgore', 'Levante Trofeo', 'MC20 Cielo', 'Quattroporte Trofeo'],
    Mazda: ['2 Hybrid', '3 Sedan', '3 Hatchback', '6 Wagon', 'CX-30 e-Skyactiv', 'CX-5 AWD', 'CX-60 PHEV', 'MX-5 RF'],
    'Mercedes-Benz': ['A-Class Sedan', 'AMG A 45', 'AMG C 63', 'AMG G 63', 'B-Class Sports Tourer', 'C-Class Estate', 'CLA Shooting Brake', 'E-Class Estate', 'GLA AMG Line', 'GLC Coupe', 'GLE Coupe', 'S-Class Maybach', 'Sprinter Tourer', 'Vito Tourer'],
    MG: ['4 Electric', '5 Electric', 'EHS Plug-in Hybrid', 'HS Trophy', 'Marvel R Performance', 'ZS EV Long Range'],
    Mini: ['Clubman Cooper S', 'Convertible Cooper S', 'Cooper S', 'Countryman Cooper S', 'Countryman Plug-in Hybrid', 'John Cooper Works'],
    Mitsubishi: ['ASX Invite', 'Colt CZ3', 'L200 Double Cab', 'Lancer Evolution', 'Outlander PHEV', 'Pajero Sport', 'Space Star Invite'],
    Nissan: ['370Z Nismo', 'Ariya Advance', 'Juke Nismo', 'Leaf e+', 'Micra K14', 'Navara Double Cab', 'Patrol GR', 'Qashqai e-Power', 'X-Trail e-Power'],
    Opel: ['Astra G', 'Astra H', 'Astra J', 'Astra K', 'Astra Sports Tourer', 'Corsa C', 'Corsa D', 'Corsa E', 'Corsa F', 'Grandland X', 'Insignia Sports Tourer', 'Mokka Electric', 'Vivaro Combi', 'Zafira Tourer'],
    Polestar: ['2 Long Range', '2 Performance', '3 Long Range', '4 Long Range'],
    Peugeot: ['206 CC', '207 SW', '208 GT', '208 GTi', '3008 Hybrid', '3008 GT', '308 SW', '308 GTi', '5008 GT', '508 SW', 'Partner Tepee', 'Traveller Long'],
    Porsche: ['718 Boxster S', '718 Cayman S', '911 Carrera', '911 Carrera 4S', '911 GT3', '911 Turbo S', 'Cayenne Coupe', 'Macan S', 'Panamera Sport Turismo', 'Taycan Cross Turismo'],
    Proton: ['Exora Bold', 'Iriz Active', 'Persona Premium', 'Saga Premium', 'X50 Flagship', 'X70 Premium'],
    Ram: ['1500 Rebel', '1500 TRX', '2500 Power Wagon', '3500 Heavy Duty', 'ProMaster City'],
    Renault: ['Captur E-Tech', 'Clio 3', 'Clio 4', 'Clio 5', 'Clio RS', 'Espace Initiale', 'Kangoo Express', 'Megane 2', 'Megane 3', 'Megane 4', 'Megane RS', 'Scenic Xmod', 'Trafic Passenger', 'Twingo Electric'],
    Rivian: ['R1S Adventure', 'R1S Performance', 'R1T Adventure', 'R1T Performance'],
    'Rolls-Royce': ['Cullinan Black Badge', 'Ghost Black Badge', 'Phantom Extended', 'Spectre Electric', 'Wraith Black Badge'],
    Rover: ['25 Streetwise', '45 Saloon', '75 Tourer', 'Streetwise SE'],
    Saab: ['9-3 Cabriolet', '9-3 SportCombi', '9-5 Aero', '900 Cabriolet', '9000 Aero'],
    Seat: ['Ibiza FR', 'Leon FR', 'Leon Sportstourer', 'Leon Cupra', 'Ateca FR', 'Tarraco FR'],
    Seres: ['3 Luxury', '5 EVR', '5 Luxury', '7 Premium'],
    Skoda: ['Fabia Combi', 'Kodiaq RS', 'Octavia Combi', 'Octavia RS', 'Rapid Spaceback', 'Superb Combi', 'Superb iV', 'Yeti Outdoor'],
    Smart: ['#1 Brabus', '#3 Brabus', 'Forfour Electric', 'Fortwo Cabrio', 'Fortwo Electric'],
    SsangYong: ['Korando e-Motion', 'Musso Grand', 'Rexton Sports', 'Tivoli Grand', 'XLV Premium'],
    Subaru: ['Forester e-Boxer', 'Impreza WRX', 'Legacy Outback', 'Outback Wilderness', 'WRX STI', 'XV e-Boxer'],
    Suzuki: ['Alto K10', 'Grand Vitara Hybrid', 'Jimny 5-door', 'S-Cross Hybrid', 'Swift Sport', 'SX4 S-Cross', 'Vitara Hybrid', 'Wagon R+'],
    Tesla: ['Model 3 Long Range', 'Model 3 Performance', 'Model S Plaid', 'Model X Plaid', 'Model Y Long Range', 'Model Y Performance'],
    Toyota: ['Auris Hybrid', 'Camry Hybrid', 'Corolla Hatchback', 'Corolla Hybrid', 'Corolla Touring Sports', 'Hilux Double Cab', 'Land Cruiser Prado', 'Prius Plug-in Hybrid', 'RAV4 Hybrid', 'Yaris Hybrid', 'Yaris GR', 'Yaris Cross Hybrid'],
    VinFast: ['VF 3 Eco', 'VF 5 Plus', 'VF 6 Plus', 'VF 7 Plus', 'VF 8 Plus', 'VF 9 Plus'],
    Volkswagen: ['Golf 1', 'Golf 2', 'Golf 3', 'Golf 4', 'Golf 5', 'Golf 6', 'Golf 7', 'Golf 8', 'Golf Cabriolet', 'Golf GTD', 'Golf GTE', 'Golf GTI', 'Golf Plus', 'Golf R', 'Golf Sportsvan', 'Golf Variant', 'Passat B5', 'Passat B6', 'Passat B7', 'Passat B8', 'Polo 4', 'Polo 5', 'Polo 6', 'Polo GTI', 'Tiguan Allspace', 'Touran 7 places', 'Transporter T5', 'Transporter T6'],
    Volvo: ['C40 Recharge', 'S60 Recharge', 'S90 Recharge', 'V40 Cross Country', 'V60 Cross Country', 'V60 Recharge', 'V90 Cross Country', 'XC40 Recharge', 'XC60 Recharge', 'XC90 Recharge'],
    Wey: ['Coffee 01 PHEV', 'Coffee 02 PHEV', 'Mocha DHT-PHEV', 'Tank 300 Hybrid', 'Tank 500 Hybrid'],
    Xpeng: ['G3i', 'G6 Long Range', 'G9 Performance', 'P5 Long Range', 'P7 Performance'],
    Zeekr: ['001 Long Range', '001 Performance', '007 Long Range', '009 Grand', 'X Privilege'],
};

Object.entries(carCatalogDetailedModels).forEach(([brand, models]) => {
    if (!carCatalog[brand]) {
        return;
    }

    carCatalog[brand] = [...new Set([...carCatalog[brand], ...models])]
        .sort((firstModel, secondModel) => firstModel.localeCompare(secondModel, 'en', { numeric: true }));
});

const defaultVehicleDimensions = {
    length: 4.50,
    width: 1.80,
    height: 1.70,
};

const dimensions = (length, width, height) => ({ length, width, height });

const vehicleDimensionsByBrandModel = {
    Abarth: {
        '124 Spider': dimensions(4.05, 1.74, 1.23),
        500: dimensions(3.66, 1.63, 1.49),
        '500 Abarth': dimensions(3.66, 1.63, 1.49),
        '595 Competizione': dimensions(3.66, 1.63, 1.49),
        '595 Turismo': dimensions(3.66, 1.63, 1.49),
        '695 Competizione': dimensions(3.66, 1.63, 1.49),
    },
    'Alfa Romeo': {
        147: dimensions(4.22, 1.73, 1.44),
        156: dimensions(4.43, 1.75, 1.42),
        159: dimensions(4.66, 1.83, 1.42),
        Giulia: dimensions(4.64, 1.86, 1.44),
        'Giulia Quadrifoglio': dimensions(4.64, 1.87, 1.43),
        Giulietta: dimensions(4.35, 1.80, 1.47),
        Stelvio: dimensions(4.69, 1.90, 1.67),
        'Stelvio Quadrifoglio': dimensions(4.70, 1.96, 1.68),
        Tonale: dimensions(4.53, 1.84, 1.60),
    },
    Audi: {
        A1: dimensions(4.03, 1.74, 1.41),
        'A1 Sportback': dimensions(4.03, 1.74, 1.41),
        A3: dimensions(4.34, 1.82, 1.45),
        'A3 Sedan': dimensions(4.50, 1.82, 1.43),
        'A3 Sportback': dimensions(4.34, 1.82, 1.45),
        A4: dimensions(4.76, 1.85, 1.43),
        'A4 Avant': dimensions(4.76, 1.85, 1.46),
        A5: dimensions(4.70, 1.85, 1.37),
        'A5 Sportback': dimensions(4.76, 1.84, 1.39),
        A6: dimensions(4.94, 1.89, 1.46),
        'A6 Avant': dimensions(4.94, 1.89, 1.47),
        A7: dimensions(4.97, 1.91, 1.42),
        'A7 Sportback': dimensions(4.97, 1.91, 1.42),
        A8: dimensions(5.19, 1.95, 1.47),
        Q2: dimensions(4.21, 1.79, 1.54),
        Q3: dimensions(4.48, 1.85, 1.62),
        'Q3 Sportback': dimensions(4.50, 1.84, 1.57),
        Q5: dimensions(4.68, 1.89, 1.66),
        Q7: dimensions(5.06, 1.97, 1.74),
        Q8: dimensions(4.99, 2.00, 1.71),
        R8: dimensions(4.43, 1.94, 1.24),
        RS3: dimensions(4.39, 1.85, 1.44),
        'RS4 Avant': dimensions(4.78, 1.87, 1.44),
        'RS6 Avant': dimensions(5.00, 1.95, 1.49),
        TT: dimensions(4.19, 1.83, 1.34),
    },
    BMW: {
        '1 Series': dimensions(4.32, 1.80, 1.43),
        '1 Series F20': dimensions(4.32, 1.77, 1.42),
        '1 Series F40': dimensions(4.32, 1.80, 1.43),
        '2 Series': dimensions(4.54, 1.84, 1.39),
        '2 Series Active Tourer': dimensions(4.39, 1.82, 1.58),
        '2 Series Gran Coupe': dimensions(4.53, 1.80, 1.42),
        '3 Series': dimensions(4.71, 1.83, 1.44),
        '3 Series E46': dimensions(4.49, 1.74, 1.42),
        '3 Series E90': dimensions(4.53, 1.82, 1.42),
        '3 Series F30': dimensions(4.62, 1.81, 1.43),
        '3 Series G20': dimensions(4.71, 1.83, 1.44),
        '3 Series Touring': dimensions(4.71, 1.83, 1.44),
        '4 Series': dimensions(4.77, 1.85, 1.38),
        '4 Series Gran Coupe': dimensions(4.78, 1.85, 1.44),
        '5 Series': dimensions(5.06, 1.90, 1.52),
        '5 Series E60': dimensions(4.84, 1.85, 1.47),
        '5 Series F10': dimensions(4.91, 1.86, 1.46),
        '5 Series G30': dimensions(4.94, 1.87, 1.48),
        '5 Series Touring': dimensions(5.06, 1.90, 1.52),
        '7 Series': dimensions(5.39, 1.95, 1.54),
        M2: dimensions(4.58, 1.89, 1.40),
        M3: dimensions(4.79, 1.90, 1.44),
        M4: dimensions(4.79, 1.89, 1.39),
        M5: dimensions(5.10, 1.97, 1.51),
        X1: dimensions(4.50, 1.85, 1.64),
        X2: dimensions(4.55, 1.85, 1.56),
        X3: dimensions(4.71, 1.89, 1.68),
        X4: dimensions(4.75, 1.92, 1.62),
        X5: dimensions(4.94, 2.00, 1.77),
        X6: dimensions(4.96, 2.00, 1.70),
        X7: dimensions(5.18, 2.00, 1.84),
    },
    Chevrolet: {
        Aveo: dimensions(4.04, 1.74, 1.52),
        Camaro: dimensions(4.78, 1.90, 1.35),
        Captiva: dimensions(4.64, 1.85, 1.76),
        Corvette: dimensions(4.63, 1.93, 1.23),
        Cruze: dimensions(4.60, 1.79, 1.48),
        Spark: dimensions(3.64, 1.60, 1.52),
        Tahoe: dimensions(5.35, 2.06, 1.93),
    },
    Citroen: {
        C1: dimensions(3.47, 1.62, 1.46),
        C2: dimensions(3.67, 1.66, 1.46),
        C3: dimensions(4.00, 1.75, 1.47),
        'C3 Aircross': dimensions(4.16, 1.76, 1.64),
        C4: dimensions(4.36, 1.80, 1.53),
        'C4 Picasso': dimensions(4.43, 1.83, 1.61),
        C5: dimensions(4.78, 1.86, 1.46),
        'C5 Aircross': dimensions(4.50, 1.86, 1.69),
        Berlingo: dimensions(4.40, 1.85, 1.84),
        Jumpy: dimensions(4.96, 1.92, 1.90),
    },
    Dacia: {
        Dokker: dimensions(4.36, 1.75, 1.81),
        Duster: dimensions(4.34, 1.81, 1.69),
        Jogger: dimensions(4.55, 1.78, 1.63),
        Lodgy: dimensions(4.50, 1.75, 1.68),
        Logan: dimensions(4.40, 1.73, 1.52),
        Sandero: dimensions(4.09, 1.76, 1.50),
        'Sandero Stepway': dimensions(4.10, 1.78, 1.59),
        Spring: dimensions(3.73, 1.58, 1.52),
    },
    Fiat: {
        '124 Spider': dimensions(4.05, 1.74, 1.23),
        500: dimensions(3.57, 1.63, 1.49),
        '500C': dimensions(3.57, 1.63, 1.49),
        '500L': dimensions(4.24, 1.78, 1.66),
        '500X': dimensions(4.26, 1.80, 1.60),
        Bravo: dimensions(4.34, 1.79, 1.50),
        Doblo: dimensions(4.41, 1.83, 1.85),
        Ducato: dimensions(5.41, 2.05, 2.25),
        'Grande Punto': dimensions(4.03, 1.69, 1.49),
        Panda: dimensions(3.69, 1.67, 1.55),
        Punto: dimensions(4.07, 1.69, 1.49),
        Tipo: dimensions(4.37, 1.79, 1.50),
    },
    Ford: {
        Fiesta: dimensions(4.04, 1.74, 1.48),
        'Fiesta Mk6': dimensions(3.95, 1.72, 1.48),
        'Fiesta Mk7': dimensions(4.04, 1.74, 1.48),
        'Fiesta ST': dimensions(4.07, 1.74, 1.47),
        Focus: dimensions(4.38, 1.83, 1.47),
        'Focus Mk2': dimensions(4.34, 1.84, 1.50),
        'Focus Mk3': dimensions(4.36, 1.82, 1.48),
        'Focus Mk4': dimensions(4.38, 1.83, 1.47),
        'Focus ST': dimensions(4.39, 1.83, 1.46),
        Kuga: dimensions(4.63, 1.88, 1.67),
        Mondeo: dimensions(4.87, 1.85, 1.48),
        Mustang: dimensions(4.81, 1.92, 1.41),
        Puma: dimensions(4.19, 1.81, 1.54),
        Ranger: dimensions(5.37, 1.92, 1.88),
        'Ranger Raptor': dimensions(5.38, 2.03, 1.92),
        Transit: dimensions(5.53, 2.06, 2.49),
    },
    Honda: {
        Accord: dimensions(4.97, 1.86, 1.45),
        City: dimensions(4.55, 1.75, 1.47),
        Civic: dimensions(4.55, 1.80, 1.42),
        'Civic Type R': dimensions(4.59, 1.89, 1.41),
        'CR-V': dimensions(4.71, 1.87, 1.68),
        'HR-V': dimensions(4.34, 1.79, 1.58),
        Jazz: dimensions(4.04, 1.69, 1.53),
    },
    Hyundai: {
        Accent: dimensions(4.44, 1.73, 1.47),
        Getz: dimensions(3.83, 1.67, 1.50),
        i10: dimensions(3.67, 1.68, 1.48),
        i20: dimensions(4.04, 1.78, 1.45),
        i30: dimensions(4.34, 1.80, 1.46),
        Kona: dimensions(4.35, 1.83, 1.58),
        'Santa Fe': dimensions(4.83, 1.90, 1.72),
        Sonata: dimensions(4.90, 1.86, 1.45),
        Tucson: dimensions(4.50, 1.87, 1.65),
    },
    Jaguar: {
        'E-Pace': dimensions(4.40, 1.90, 1.65),
        'F-Pace': dimensions(4.75, 1.94, 1.66),
        'F-Type': dimensions(4.47, 1.92, 1.31),
        'I-Pace': dimensions(4.68, 1.90, 1.57),
        XE: dimensions(4.68, 1.85, 1.42),
        XF: dimensions(4.96, 1.88, 1.46),
        XJ: dimensions(5.13, 1.90, 1.46),
    },
    Jeep: {
        Cherokee: dimensions(4.62, 1.86, 1.68),
        Compass: dimensions(4.40, 1.82, 1.65),
        'Grand Cherokee': dimensions(4.91, 1.98, 1.80),
        Renegade: dimensions(4.24, 1.81, 1.67),
        Wrangler: dimensions(4.88, 1.89, 1.84),
    },
    Kia: {
        Ceed: dimensions(4.31, 1.80, 1.45),
        Niro: dimensions(4.42, 1.83, 1.57),
        Picanto: dimensions(3.60, 1.60, 1.49),
        Rio: dimensions(4.07, 1.73, 1.45),
        Sorento: dimensions(4.81, 1.90, 1.70),
        Soul: dimensions(4.20, 1.80, 1.61),
        Sportage: dimensions(4.52, 1.87, 1.65),
        Stinger: dimensions(4.83, 1.87, 1.40),
    },
    'Land Rover': {
        Defender: dimensions(5.02, 2.00, 1.97),
        'Defender 90': dimensions(4.58, 2.00, 1.97),
        'Defender 110': dimensions(5.02, 2.00, 1.97),
        Discovery: dimensions(4.96, 2.00, 1.89),
        'Discovery Sport': dimensions(4.60, 1.89, 1.73),
        Freelander: dimensions(4.50, 1.91, 1.74),
        'Range Rover': dimensions(5.05, 2.05, 1.87),
        'Range Rover Evoque': dimensions(4.37, 1.90, 1.65),
        'Range Rover Sport': dimensions(4.95, 2.00, 1.82),
        'Range Rover Velar': dimensions(4.80, 1.93, 1.67),
    },
    Lexus: {
        CT: dimensions(4.36, 1.77, 1.46),
        ES: dimensions(4.98, 1.87, 1.45),
        IS: dimensions(4.71, 1.84, 1.44),
        LS: dimensions(5.24, 1.90, 1.46),
        NX: dimensions(4.66, 1.87, 1.66),
        RX: dimensions(4.89, 1.92, 1.70),
        UX: dimensions(4.50, 1.84, 1.54),
    },
    Mazda: {
        2: dimensions(4.07, 1.70, 1.50),
        3: dimensions(4.46, 1.80, 1.44),
        5: dimensions(4.59, 1.75, 1.62),
        6: dimensions(4.87, 1.84, 1.45),
        'CX-3': dimensions(4.28, 1.77, 1.54),
        'CX-30': dimensions(4.40, 1.80, 1.54),
        'CX-5': dimensions(4.58, 1.84, 1.68),
        'CX-60': dimensions(4.75, 1.89, 1.68),
        'MX-5': dimensions(3.92, 1.74, 1.23),
    },
    'Mercedes-Benz': {
        'A-Class': dimensions(4.42, 1.80, 1.44),
        'A-Class Sedan': dimensions(4.55, 1.80, 1.45),
        'B-Class': dimensions(4.42, 1.80, 1.56),
        'C-Class': dimensions(4.75, 1.82, 1.44),
        'C-Class Estate': dimensions(4.75, 1.84, 1.46),
        CLA: dimensions(4.69, 1.83, 1.44),
        CLS: dimensions(4.99, 1.89, 1.44),
        'E-Class': dimensions(4.95, 1.88, 1.47),
        'G-Class': dimensions(4.82, 1.93, 1.97),
        GLA: dimensions(4.41, 1.83, 1.61),
        GLB: dimensions(4.63, 1.83, 1.66),
        GLC: dimensions(4.72, 1.89, 1.64),
        GLE: dimensions(4.92, 1.95, 1.80),
        GLS: dimensions(5.21, 2.03, 1.82),
        'S-Class': dimensions(5.18, 1.92, 1.50),
        Sprinter: dimensions(5.93, 1.99, 2.43),
        'V-Class': dimensions(5.14, 1.93, 1.88),
        Vito: dimensions(5.14, 1.93, 1.91),
    },
    Mini: {
        Clubman: dimensions(4.27, 1.80, 1.44),
        Convertible: dimensions(3.86, 1.73, 1.42),
        Cooper: dimensions(3.86, 1.73, 1.41),
        Countryman: dimensions(4.30, 1.82, 1.56),
        Paceman: dimensions(4.11, 1.79, 1.52),
    },
    Mitsubishi: {
        ASX: dimensions(4.37, 1.81, 1.64),
        Colt: dimensions(4.05, 1.73, 1.44),
        L200: dimensions(5.31, 1.82, 1.78),
        Lancer: dimensions(4.57, 1.76, 1.49),
        Outlander: dimensions(4.71, 1.86, 1.75),
        Pajero: dimensions(4.90, 1.88, 1.90),
        'Space Star': dimensions(3.85, 1.67, 1.51),
    },
    Nissan: {
        Almera: dimensions(4.50, 1.74, 1.46),
        Ariya: dimensions(4.60, 1.85, 1.66),
        Juke: dimensions(4.21, 1.80, 1.60),
        Leaf: dimensions(4.49, 1.79, 1.54),
        Micra: dimensions(4.00, 1.74, 1.46),
        Navara: dimensions(5.33, 1.85, 1.82),
        Pathfinder: dimensions(5.00, 1.98, 1.77),
        Patrol: dimensions(5.17, 1.99, 1.94),
        Qashqai: dimensions(4.43, 1.84, 1.63),
        'X-Trail': dimensions(4.68, 1.84, 1.72),
    },
    Opel: {
        Adam: dimensions(3.70, 1.72, 1.48),
        Astra: dimensions(4.37, 1.81, 1.49),
        'Astra G': dimensions(4.11, 1.71, 1.43),
        'Astra H': dimensions(4.25, 1.75, 1.46),
        'Astra J': dimensions(4.42, 1.81, 1.51),
        'Astra K': dimensions(4.37, 1.81, 1.49),
        Corsa: dimensions(4.06, 1.77, 1.43),
        'Corsa C': dimensions(3.84, 1.65, 1.44),
        'Corsa D': dimensions(4.00, 1.71, 1.49),
        'Corsa E': dimensions(4.02, 1.74, 1.48),
        'Corsa F': dimensions(4.06, 1.77, 1.43),
        Grandland: dimensions(4.48, 1.86, 1.61),
        Insignia: dimensions(4.90, 1.86, 1.46),
        Mokka: dimensions(4.15, 1.79, 1.53),
        Vivaro: dimensions(4.96, 1.92, 1.90),
        Zafira: dimensions(4.66, 1.82, 1.69),
    },
    Peugeot: {
        106: dimensions(3.68, 1.59, 1.38),
        107: dimensions(3.43, 1.63, 1.47),
        108: dimensions(3.48, 1.62, 1.46),
        2008: dimensions(4.30, 1.77, 1.55),
        206: dimensions(3.84, 1.65, 1.43),
        '206 CC': dimensions(3.84, 1.67, 1.37),
        207: dimensions(4.05, 1.75, 1.47),
        '207 SW': dimensions(4.16, 1.75, 1.53),
        208: dimensions(4.06, 1.75, 1.43),
        '208 GT': dimensions(4.06, 1.75, 1.43),
        '208 GTi': dimensions(3.97, 1.74, 1.46),
        3008: dimensions(4.45, 1.84, 1.62),
        308: dimensions(4.37, 1.80, 1.44),
        '308 GTi': dimensions(4.25, 1.80, 1.45),
        '308 SW': dimensions(4.64, 1.85, 1.44),
        5008: dimensions(4.64, 1.84, 1.65),
        508: dimensions(4.75, 1.86, 1.40),
        Partner: dimensions(4.40, 1.85, 1.84),
        Traveller: dimensions(4.96, 1.92, 1.90),
    },
    Porsche: {
        '718 Boxster': dimensions(4.38, 1.80, 1.28),
        '718 Cayman': dimensions(4.38, 1.80, 1.30),
        911: dimensions(4.52, 1.85, 1.30),
        Cayenne: dimensions(4.93, 1.98, 1.70),
        Macan: dimensions(4.73, 1.92, 1.62),
        Panamera: dimensions(5.05, 1.94, 1.43),
        Taycan: dimensions(4.96, 1.97, 1.38),
    },
    Renault: {
        Captur: dimensions(4.23, 1.80, 1.58),
        Clio: dimensions(4.05, 1.80, 1.44),
        'Clio 3': dimensions(4.03, 1.72, 1.50),
        'Clio 4': dimensions(4.06, 1.73, 1.45),
        'Clio 5': dimensions(4.05, 1.80, 1.44),
        'Clio RS': dimensions(4.09, 1.73, 1.43),
        Espace: dimensions(4.86, 1.89, 1.68),
        Kadjar: dimensions(4.45, 1.84, 1.61),
        Kangoo: dimensions(4.49, 1.86, 1.84),
        Koleos: dimensions(4.67, 1.84, 1.67),
        Megane: dimensions(4.36, 1.81, 1.45),
        'Megane 2': dimensions(4.21, 1.78, 1.46),
        'Megane 3': dimensions(4.30, 1.81, 1.47),
        'Megane 4': dimensions(4.36, 1.81, 1.45),
        'Megane RS': dimensions(4.37, 1.88, 1.44),
        Scenic: dimensions(4.41, 1.87, 1.65),
        Trafic: dimensions(5.08, 1.96, 1.97),
        Twingo: dimensions(3.61, 1.65, 1.54),
        Zoe: dimensions(4.09, 1.73, 1.56),
    },
    Seat: {
        Arona: dimensions(4.15, 1.78, 1.54),
        Ateca: dimensions(4.36, 1.84, 1.60),
        Ibiza: dimensions(4.06, 1.78, 1.44),
        Leon: dimensions(4.37, 1.80, 1.46),
        Tarraco: dimensions(4.74, 1.84, 1.67),
    },
    Skoda: {
        Fabia: dimensions(4.11, 1.78, 1.46),
        Kamiq: dimensions(4.24, 1.79, 1.55),
        Karoq: dimensions(4.39, 1.84, 1.60),
        Kodiaq: dimensions(4.70, 1.88, 1.68),
        Octavia: dimensions(4.69, 1.83, 1.47),
        Superb: dimensions(4.91, 1.86, 1.46),
        Yeti: dimensions(4.22, 1.79, 1.69),
    },
    Smart: {
        Forfour: dimensions(3.50, 1.67, 1.55),
        Fortwo: dimensions(2.70, 1.66, 1.55),
        Roadster: dimensions(3.43, 1.62, 1.19),
    },
    Suzuki: {
        Alto: dimensions(3.50, 1.60, 1.47),
        Baleno: dimensions(3.99, 1.75, 1.47),
        'Grand Vitara': dimensions(4.50, 1.81, 1.70),
        Ignis: dimensions(3.70, 1.69, 1.60),
        Jimny: dimensions(3.65, 1.65, 1.72),
        Swift: dimensions(3.86, 1.74, 1.50),
        Vitara: dimensions(4.18, 1.78, 1.61),
    },
    Tesla: {
        'Model 3': dimensions(4.69, 1.85, 1.44),
        'Model 3 Long Range': dimensions(4.69, 1.85, 1.44),
        'Model 3 Performance': dimensions(4.69, 1.85, 1.44),
        'Model S': dimensions(4.98, 1.96, 1.45),
        'Model S Plaid': dimensions(4.98, 1.96, 1.45),
        'Model X': dimensions(5.04, 2.00, 1.68),
        'Model X Plaid': dimensions(5.04, 2.00, 1.68),
        'Model Y': dimensions(4.75, 1.92, 1.62),
        'Model Y Long Range': dimensions(4.75, 1.92, 1.62),
        'Model Y Performance': dimensions(4.75, 1.92, 1.62),
    },
    Toyota: {
        Auris: dimensions(4.33, 1.76, 1.48),
        Aygo: dimensions(3.47, 1.62, 1.46),
        Camry: dimensions(4.89, 1.84, 1.45),
        Corolla: dimensions(4.37, 1.79, 1.44),
        'Corolla Cross': dimensions(4.46, 1.83, 1.62),
        'Corolla Hatchback': dimensions(4.37, 1.79, 1.44),
        'Corolla Hybrid': dimensions(4.37, 1.79, 1.44),
        'Corolla Touring Sports': dimensions(4.65, 1.79, 1.44),
        Hilux: dimensions(5.33, 1.86, 1.82),
        'Land Cruiser': dimensions(4.92, 1.98, 1.87),
        Prius: dimensions(4.60, 1.78, 1.43),
        RAV4: dimensions(4.60, 1.85, 1.69),
        Supra: dimensions(4.38, 1.85, 1.29),
        Yaris: dimensions(3.94, 1.75, 1.50),
        'Yaris Cross': dimensions(4.18, 1.77, 1.60),
        'Yaris GR': dimensions(4.00, 1.81, 1.46),
        'Yaris Hybrid': dimensions(3.94, 1.75, 1.50),
    },
    Volkswagen: {
        Amarok: dimensions(5.35, 1.91, 1.89),
        Arteon: dimensions(4.87, 1.87, 1.45),
        Beetle: dimensions(4.28, 1.81, 1.49),
        Caddy: dimensions(4.50, 1.86, 1.80),
        Crafter: dimensions(5.99, 2.04, 2.36),
        Golf: dimensions(4.28, 1.79, 1.46),
        'Golf 1': dimensions(3.71, 1.61, 1.41),
        'Golf 2': dimensions(3.99, 1.67, 1.42),
        'Golf 3': dimensions(4.02, 1.69, 1.43),
        'Golf 4': dimensions(4.15, 1.74, 1.44),
        'Golf 5': dimensions(4.20, 1.76, 1.48),
        'Golf 6': dimensions(4.20, 1.78, 1.48),
        'Golf 7': dimensions(4.26, 1.80, 1.45),
        'Golf 8': dimensions(4.28, 1.79, 1.46),
        'Golf Cabriolet': dimensions(4.25, 1.78, 1.42),
        'Golf GTD': dimensions(4.27, 1.80, 1.46),
        'Golf GTE': dimensions(4.27, 1.80, 1.48),
        'Golf GTI': dimensions(4.29, 1.79, 1.46),
        'Golf Plus': dimensions(4.21, 1.76, 1.58),
        'Golf R': dimensions(4.29, 1.79, 1.46),
        'Golf Sportsvan': dimensions(4.34, 1.81, 1.58),
        'Golf Variant': dimensions(4.63, 1.80, 1.50),
        Jetta: dimensions(4.70, 1.80, 1.46),
        Passat: dimensions(4.78, 1.83, 1.46),
        'Passat B5': dimensions(4.68, 1.74, 1.46),
        'Passat B6': dimensions(4.77, 1.82, 1.47),
        'Passat B7': dimensions(4.77, 1.82, 1.47),
        'Passat B8': dimensions(4.77, 1.83, 1.46),
        Polo: dimensions(4.07, 1.75, 1.45),
        'Polo 4': dimensions(3.92, 1.65, 1.47),
        'Polo 5': dimensions(3.97, 1.68, 1.46),
        'Polo 6': dimensions(4.07, 1.75, 1.45),
        'Polo GTI': dimensions(4.07, 1.75, 1.44),
        'T-Cross': dimensions(4.11, 1.76, 1.58),
        'T-Roc': dimensions(4.24, 1.82, 1.57),
        Tiguan: dimensions(4.51, 1.84, 1.68),
        'Tiguan Allspace': dimensions(4.73, 1.84, 1.67),
        Touareg: dimensions(4.88, 1.98, 1.70),
        Touran: dimensions(4.53, 1.83, 1.66),
        'Touran 7 places': dimensions(4.53, 1.83, 1.66),
        Transporter: dimensions(4.90, 1.90, 1.99),
        'Transporter T5': dimensions(4.89, 1.90, 1.99),
        'Transporter T6': dimensions(4.90, 1.90, 1.99),
        Up: dimensions(3.60, 1.65, 1.50),
    },
    Volvo: {
        C30: dimensions(4.27, 1.78, 1.45),
        S40: dimensions(4.47, 1.77, 1.45),
        S60: dimensions(4.76, 1.85, 1.44),
        S90: dimensions(4.96, 1.88, 1.44),
        V40: dimensions(4.37, 1.80, 1.44),
        V60: dimensions(4.76, 1.85, 1.43),
        V90: dimensions(4.94, 1.88, 1.48),
        XC40: dimensions(4.44, 1.87, 1.65),
        XC60: dimensions(4.71, 1.90, 1.66),
        XC90: dimensions(4.95, 1.96, 1.78),
    },
};

const vehicleGenerationRules = {
    Audi: {
        A1: [
            { from: 2010, to: 2018, model: 'A1 8X' },
            { from: 2019, to: 2027, model: 'A1 GB' },
        ],
        A3: [
            { from: 1996, to: 2003, model: 'A3 8L' },
            { from: 2004, to: 2012, model: 'A3 8P' },
            { from: 2013, to: 2020, model: 'A3 8V' },
            { from: 2021, to: 2027, model: 'A3 8Y' },
        ],
        A4: [
            { from: 1995, to: 2000, model: 'A4 B5' },
            { from: 2001, to: 2008, model: 'A4 B6/B7' },
            { from: 2009, to: 2015, model: 'A4 B8' },
            { from: 2016, to: 2024, model: 'A4 B9' },
            { from: 2025, to: 2027, model: 'A4 B10' },
        ],
        A6: [
            { from: 1998, to: 2004, model: 'A6 C5' },
            { from: 2005, to: 2011, model: 'A6 C6' },
            { from: 2012, to: 2018, model: 'A6 C7' },
            { from: 2019, to: 2027, model: 'A6 C8' },
        ],
        Q3: [
            { from: 2012, to: 2018, model: 'Q3 8U' },
            { from: 2019, to: 2027, model: 'Q3 F3' },
        ],
        Q5: [
            { from: 2009, to: 2016, model: 'Q5 8R' },
            { from: 2017, to: 2027, model: 'Q5 FY' },
        ],
    },
    BMW: {
        '1 Series': [
            { from: 2004, to: 2011, model: '1 Series F20' },
            { from: 2012, to: 2019, model: '1 Series F20' },
            { from: 2020, to: 2027, model: '1 Series F40' },
        ],
        '3 Series': [
            { from: 1998, to: 2005, model: '3 Series E46' },
            { from: 2006, to: 2011, model: '3 Series E90' },
            { from: 2012, to: 2018, model: '3 Series F30' },
            { from: 2019, to: 2027, model: '3 Series G20' },
        ],
        '5 Series': [
            { from: 2003, to: 2010, model: '5 Series E60' },
            { from: 2011, to: 2016, model: '5 Series F10' },
            { from: 2017, to: 2023, model: '5 Series G30' },
            { from: 2024, to: 2027, model: '5 Series' },
        ],
    },
    Citroen: {
        C1: [
            { from: 2005, to: 2014, model: 'C1 1' },
            { from: 2015, to: 2022, model: 'C1 2' },
        ],
        C3: [
            { from: 2002, to: 2009, model: 'C3 1' },
            { from: 2010, to: 2016, model: 'C3 2' },
            { from: 2017, to: 2023, model: 'C3 3' },
            { from: 2024, to: 2027, model: 'C3 4' },
        ],
        C4: [
            { from: 2005, to: 2010, model: 'C4 1' },
            { from: 2011, to: 2018, model: 'C4 2' },
            { from: 2021, to: 2027, model: 'C4 3' },
        ],
        Berlingo: [
            { from: 1997, to: 2008, model: 'Berlingo 1' },
            { from: 2009, to: 2018, model: 'Berlingo 2' },
            { from: 2019, to: 2027, model: 'Berlingo 3' },
        ],
    },
    Dacia: {
        Duster: [
            { from: 2010, to: 2017, model: 'Duster 1' },
            { from: 2018, to: 2023, model: 'Duster 2' },
            { from: 2024, to: 2027, model: 'Duster 3' },
        ],
        Logan: [
            { from: 2005, to: 2012, model: 'Logan 1' },
            { from: 2013, to: 2020, model: 'Logan 2' },
            { from: 2021, to: 2027, model: 'Logan 3' },
        ],
        Sandero: [
            { from: 2008, to: 2012, model: 'Sandero 1' },
            { from: 2013, to: 2020, model: 'Sandero 2' },
            { from: 2021, to: 2027, model: 'Sandero 3' },
        ],
    },
    Ford: {
        Fiesta: [
            { from: 2008, to: 2016, model: 'Fiesta Mk6' },
            { from: 2017, to: 2023, model: 'Fiesta Mk7' },
        ],
        Focus: [
            { from: 2004, to: 2010, model: 'Focus Mk2' },
            { from: 2011, to: 2018, model: 'Focus Mk3' },
            { from: 2019, to: 2027, model: 'Focus Mk4' },
        ],
    },
    Hyundai: {
        i10: [
            { from: 2008, to: 2013, model: 'i10 1' },
            { from: 2014, to: 2019, model: 'i10 2' },
            { from: 2020, to: 2027, model: 'i10 3' },
        ],
        i20: [
            { from: 2009, to: 2014, model: 'i20 1' },
            { from: 2015, to: 2020, model: 'i20 2' },
            { from: 2021, to: 2027, model: 'i20 3' },
        ],
        i30: [
            { from: 2008, to: 2012, model: 'i30 1' },
            { from: 2013, to: 2016, model: 'i30 2' },
            { from: 2017, to: 2027, model: 'i30 3' },
        ],
        Tucson: [
            { from: 2005, to: 2009, model: 'Tucson 1' },
            { from: 2010, to: 2015, model: 'Tucson 2' },
            { from: 2016, to: 2020, model: 'Tucson 3' },
            { from: 2021, to: 2027, model: 'Tucson 4' },
        ],
    },
    Honda: {
        Civic: [
            { from: 2006, to: 2011, model: 'Civic 8' },
            { from: 2012, to: 2016, model: 'Civic 9' },
            { from: 2017, to: 2021, model: 'Civic 10' },
            { from: 2022, to: 2027, model: 'Civic 11' },
        ],
    },
    Kia: {
        Ceed: [
            { from: 2007, to: 2012, model: 'Ceed 1' },
            { from: 2013, to: 2018, model: 'Ceed 2' },
            { from: 2019, to: 2027, model: 'Ceed 3' },
        ],
        Picanto: [
            { from: 2004, to: 2010, model: 'Picanto 1' },
            { from: 2011, to: 2017, model: 'Picanto 2' },
            { from: 2018, to: 2027, model: 'Picanto 3' },
        ],
        Rio: [
            { from: 2006, to: 2011, model: 'Rio 2' },
            { from: 2012, to: 2017, model: 'Rio 3' },
            { from: 2018, to: 2023, model: 'Rio 4' },
        ],
        Sportage: [
            { from: 2005, to: 2010, model: 'Sportage 2' },
            { from: 2011, to: 2015, model: 'Sportage 3' },
            { from: 2016, to: 2021, model: 'Sportage 4' },
            { from: 2022, to: 2027, model: 'Sportage 5' },
        ],
    },
    'Mercedes-Benz': {
        'A-Class': [
            { from: 1998, to: 2004, model: 'A-Class W168' },
            { from: 2005, to: 2011, model: 'A-Class W169' },
            { from: 2012, to: 2018, model: 'A-Class W176' },
            { from: 2019, to: 2027, model: 'A-Class W177' },
        ],
        'C-Class': [
            { from: 1994, to: 2000, model: 'C-Class W202' },
            { from: 2001, to: 2007, model: 'C-Class W203' },
            { from: 2008, to: 2014, model: 'C-Class W204' },
            { from: 2015, to: 2021, model: 'C-Class W205' },
            { from: 2022, to: 2027, model: 'C-Class W206' },
        ],
        'E-Class': [
            { from: 1996, to: 2002, model: 'E-Class W210' },
            { from: 2003, to: 2009, model: 'E-Class W211' },
            { from: 2010, to: 2016, model: 'E-Class W212' },
            { from: 2017, to: 2023, model: 'E-Class W213' },
            { from: 2024, to: 2027, model: 'E-Class W214' },
        ],
    },
    Nissan: {
        Micra: [
            { from: 1993, to: 2002, model: 'Micra K11' },
            { from: 2003, to: 2010, model: 'Micra K12' },
            { from: 2011, to: 2016, model: 'Micra K13' },
            { from: 2017, to: 2022, model: 'Micra K14' },
        ],
        Qashqai: [
            { from: 2007, to: 2013, model: 'Qashqai J10' },
            { from: 2014, to: 2021, model: 'Qashqai J11' },
            { from: 2022, to: 2027, model: 'Qashqai J12' },
        ],
        'X-Trail': [
            { from: 2001, to: 2007, model: 'X-Trail T30' },
            { from: 2008, to: 2013, model: 'X-Trail T31' },
            { from: 2014, to: 2021, model: 'X-Trail T32' },
            { from: 2022, to: 2027, model: 'X-Trail T33' },
        ],
    },
    Opel: {
        Astra: [
            { from: 1998, to: 2004, model: 'Astra G' },
            { from: 2005, to: 2009, model: 'Astra H' },
            { from: 2010, to: 2015, model: 'Astra J' },
            { from: 2016, to: 2021, model: 'Astra K' },
            { from: 2022, to: 2027, model: 'Astra' },
        ],
        Corsa: [
            { from: 2000, to: 2006, model: 'Corsa C' },
            { from: 2007, to: 2014, model: 'Corsa D' },
            { from: 2015, to: 2019, model: 'Corsa E' },
            { from: 2020, to: 2027, model: 'Corsa F' },
        ],
    },
    Peugeot: {
        208: [
            { from: 2012, to: 2019, model: '208 1' },
            { from: 2020, to: 2027, model: '208 2' },
        ],
        308: [
            { from: 2008, to: 2013, model: '308 1' },
            { from: 2014, to: 2021, model: '308 2' },
            { from: 2022, to: 2027, model: '308 3' },
        ],
        2008: [
            { from: 2013, to: 2019, model: '2008 1' },
            { from: 2020, to: 2027, model: '2008 2' },
        ],
        3008: [
            { from: 2009, to: 2016, model: '3008 1' },
            { from: 2017, to: 2023, model: '3008 2' },
            { from: 2024, to: 2027, model: '3008 3' },
        ],
        5008: [
            { from: 2010, to: 2016, model: '5008 1' },
            { from: 2017, to: 2023, model: '5008 2' },
            { from: 2024, to: 2027, model: '5008 3' },
        ],
    },
    Renault: {
        Captur: [
            { from: 2013, to: 2019, model: 'Captur 1' },
            { from: 2020, to: 2027, model: 'Captur 2' },
        ],
        Clio: [
            { from: 2005, to: 2012, model: 'Clio 3' },
            { from: 2013, to: 2019, model: 'Clio 4' },
            { from: 2020, to: 2027, model: 'Clio 5' },
        ],
        Megane: [
            { from: 2002, to: 2008, model: 'Megane 2' },
            { from: 2009, to: 2015, model: 'Megane 3' },
            { from: 2016, to: 2027, model: 'Megane 4' },
        ],
        Scenic: [
            { from: 2004, to: 2009, model: 'Scenic 2' },
            { from: 2009, to: 2016, model: 'Scenic 3' },
            { from: 2017, to: 2023, model: 'Scenic 4' },
            { from: 2024, to: 2027, model: 'Scenic E-Tech' },
        ],
        Twingo: [
            { from: 1993, to: 2007, model: 'Twingo 1' },
            { from: 2008, to: 2014, model: 'Twingo 2' },
            { from: 2015, to: 2027, model: 'Twingo 3' },
        ],
    },
    Seat: {
        Ibiza: [
            { from: 1993, to: 2001, model: 'Ibiza 2' },
            { from: 2002, to: 2008, model: 'Ibiza 3' },
            { from: 2009, to: 2016, model: 'Ibiza 4' },
            { from: 2017, to: 2027, model: 'Ibiza 5' },
        ],
        Leon: [
            { from: 2000, to: 2005, model: 'Leon 1' },
            { from: 2006, to: 2012, model: 'Leon 2' },
            { from: 2013, to: 2020, model: 'Leon 3' },
            { from: 2021, to: 2027, model: 'Leon 4' },
        ],
    },
    Skoda: {
        Fabia: [
            { from: 2000, to: 2007, model: 'Fabia 1' },
            { from: 2008, to: 2014, model: 'Fabia 2' },
            { from: 2015, to: 2021, model: 'Fabia 3' },
            { from: 2022, to: 2027, model: 'Fabia 4' },
        ],
        Octavia: [
            { from: 1997, to: 2004, model: 'Octavia 1' },
            { from: 2005, to: 2012, model: 'Octavia 2' },
            { from: 2013, to: 2019, model: 'Octavia 3' },
            { from: 2020, to: 2027, model: 'Octavia 4' },
        ],
        Superb: [
            { from: 2002, to: 2008, model: 'Superb 1' },
            { from: 2009, to: 2015, model: 'Superb 2' },
            { from: 2016, to: 2023, model: 'Superb 3' },
            { from: 2024, to: 2027, model: 'Superb 4' },
        ],
    },
    Toyota: {
        Corolla: [
            { from: 1998, to: 2001, model: 'Corolla E110' },
            { from: 2002, to: 2006, model: 'Corolla E120' },
            { from: 2007, to: 2013, model: 'Corolla E140' },
            { from: 2014, to: 2018, model: 'Corolla E170' },
            { from: 2019, to: 2027, model: 'Corolla E210' },
        ],
        RAV4: [
            { from: 2001, to: 2005, model: 'RAV4 2' },
            { from: 2006, to: 2012, model: 'RAV4 3' },
            { from: 2013, to: 2018, model: 'RAV4 4' },
            { from: 2019, to: 2027, model: 'RAV4 5' },
        ],
        Yaris: [
            { from: 1999, to: 2005, model: 'Yaris 1' },
            { from: 2006, to: 2010, model: 'Yaris 2' },
            { from: 2011, to: 2019, model: 'Yaris 3' },
            { from: 2020, to: 2027, model: 'Yaris 4' },
        ],
    },
    Volkswagen: {
        Golf: [
            { from: 1974, to: 1983, model: 'Golf 1' },
            { from: 1984, to: 1991, model: 'Golf 2' },
            { from: 1992, to: 1997, model: 'Golf 3' },
            { from: 1998, to: 2003, model: 'Golf 4' },
            { from: 2004, to: 2008, model: 'Golf 5' },
            { from: 2009, to: 2012, model: 'Golf 6' },
            { from: 2013, to: 2019, model: 'Golf 7' },
            { from: 2020, to: 2027, model: 'Golf 8' },
        ],
        Passat: [
            { from: 1996, to: 2005, model: 'Passat B5' },
            { from: 2006, to: 2010, model: 'Passat B6' },
            { from: 2011, to: 2014, model: 'Passat B7' },
            { from: 2015, to: 2023, model: 'Passat B8' },
            { from: 2024, to: 2027, model: 'Passat' },
        ],
        Polo: [
            { from: 2002, to: 2009, model: 'Polo 4' },
            { from: 2010, to: 2017, model: 'Polo 5' },
            { from: 2018, to: 2027, model: 'Polo 6' },
        ],
        Transporter: [
            { from: 2003, to: 2015, model: 'Transporter T5' },
            { from: 2016, to: 2027, model: 'Transporter T6' },
        ],
        Caddy: [
            { from: 1996, to: 2003, model: 'Caddy 2' },
            { from: 2004, to: 2015, model: 'Caddy 3' },
            { from: 2016, to: 2020, model: 'Caddy 4' },
            { from: 2021, to: 2027, model: 'Caddy 5' },
        ],
        Tiguan: [
            { from: 2008, to: 2016, model: 'Tiguan 1' },
            { from: 2017, to: 2023, model: 'Tiguan 2' },
            { from: 2024, to: 2027, model: 'Tiguan 3' },
        ],
        Touran: [
            { from: 2003, to: 2015, model: 'Touran 1' },
            { from: 2016, to: 2027, model: 'Touran 2' },
        ],
        Touareg: [
            { from: 2003, to: 2010, model: 'Touareg 1' },
            { from: 2011, to: 2017, model: 'Touareg 2' },
            { from: 2018, to: 2027, model: 'Touareg 3' },
        ],
    },
};

const vehicleDimensionProfiles = [
    { keywords: ['Golf 1'], dimensions: { length: 3.71, width: 1.61, height: 1.41 } },
    { keywords: ['Golf 2'], dimensions: { length: 3.99, width: 1.67, height: 1.42 } },
    { keywords: ['Golf 3', 'Golf Cabriolet'], dimensions: { length: 4.02, width: 1.69, height: 1.43 } },
    { keywords: ['Golf 4'], dimensions: { length: 4.15, width: 1.74, height: 1.44 } },
    { keywords: ['Golf 5', 'Golf 6', 'Golf Plus'], dimensions: { length: 4.21, width: 1.76, height: 1.50 } },
    { keywords: ['Golf 7', 'Golf GTD', 'Golf GTE', 'Golf GTI', 'Golf R'], dimensions: { length: 4.26, width: 1.80, height: 1.45 } },
    { keywords: ['Golf 8'], dimensions: { length: 4.28, width: 1.79, height: 1.46 } },
    { keywords: ['Golf Sportsvan'], dimensions: { length: 4.34, width: 1.81, height: 1.58 } },
    { keywords: ['Golf Variant'], dimensions: { length: 4.63, width: 1.80, height: 1.50 } },
    { keywords: ['Passat B5'], dimensions: { length: 4.68, width: 1.74, height: 1.46 } },
    { keywords: ['Passat B6', 'Passat B7'], dimensions: { length: 4.77, width: 1.82, height: 1.47 } },
    { keywords: ['Passat B8'], dimensions: { length: 4.77, width: 1.83, height: 1.46 } },
    { keywords: ['Polo 4'], dimensions: { length: 3.92, width: 1.65, height: 1.47 } },
    { keywords: ['Polo 5'], dimensions: { length: 3.97, width: 1.68, height: 1.46 } },
    { keywords: ['Polo 6', 'Polo GTI'], dimensions: { length: 4.07, width: 1.75, height: 1.45 } },
    { keywords: ['Transporter T5', 'Transporter T6'], dimensions: { length: 4.90, width: 1.90, height: 1.99 } },
    { keywords: ['Touran 7 places'], dimensions: { length: 4.53, width: 1.83, height: 1.66 } },
    { keywords: ['Tiguan Allspace'], dimensions: { length: 4.73, width: 1.84, height: 1.67 } },
    { keywords: ['3 Series E46'], dimensions: { length: 4.49, width: 1.74, height: 1.42 } },
    { keywords: ['3 Series E90'], dimensions: { length: 4.53, width: 1.82, height: 1.42 } },
    { keywords: ['3 Series F30'], dimensions: { length: 4.62, width: 1.81, height: 1.43 } },
    { keywords: ['3 Series G20'], dimensions: { length: 4.71, width: 1.83, height: 1.44 } },
    { keywords: ['5 Series E60'], dimensions: { length: 4.84, width: 1.85, height: 1.47 } },
    { keywords: ['5 Series F10'], dimensions: { length: 4.91, width: 1.86, height: 1.46 } },
    { keywords: ['5 Series G30'], dimensions: { length: 4.94, width: 1.87, height: 1.48 } },
    { keywords: ['1 Series F20', '1 Series F40'], dimensions: { length: 4.32, width: 1.80, height: 1.43 } },
    { keywords: ['2 Series Gran Coupe', '4 Series Gran Coupe'], dimensions: { length: 4.55, width: 1.83, height: 1.43 } },
    { keywords: ['2 Series Active Tourer'], dimensions: { length: 4.39, width: 1.82, height: 1.58 } },
    { keywords: ['M2', 'M3', 'M4'], dimensions: { length: 4.65, width: 1.88, height: 1.40 } },
    { keywords: ['M5'], dimensions: { length: 4.98, width: 1.90, height: 1.47 } },
    { keywords: ['Clio 3'], dimensions: { length: 4.03, width: 1.72, height: 1.50 } },
    { keywords: ['Clio 4'], dimensions: { length: 4.06, width: 1.73, height: 1.45 } },
    { keywords: ['Clio 5', 'Clio RS'], dimensions: { length: 4.05, width: 1.80, height: 1.44 } },
    { keywords: ['Megane 2'], dimensions: { length: 4.21, width: 1.78, height: 1.46 } },
    { keywords: ['Megane 3'], dimensions: { length: 4.30, width: 1.81, height: 1.47 } },
    { keywords: ['Megane 4', 'Megane RS'], dimensions: { length: 4.36, width: 1.81, height: 1.45 } },
    { keywords: ['Corsa C'], dimensions: { length: 3.84, width: 1.65, height: 1.44 } },
    { keywords: ['Corsa D'], dimensions: { length: 4.00, width: 1.71, height: 1.49 } },
    { keywords: ['Corsa E'], dimensions: { length: 4.02, width: 1.74, height: 1.48 } },
    { keywords: ['Corsa F'], dimensions: { length: 4.06, width: 1.77, height: 1.43 } },
    { keywords: ['Astra G'], dimensions: { length: 4.11, width: 1.71, height: 1.43 } },
    { keywords: ['Astra H'], dimensions: { length: 4.25, width: 1.75, height: 1.46 } },
    { keywords: ['Astra J'], dimensions: { length: 4.42, width: 1.81, height: 1.51 } },
    { keywords: ['Astra K'], dimensions: { length: 4.37, width: 1.81, height: 1.49 } },
    { keywords: ['Civic 8', 'Civic 9'], dimensions: { length: 4.30, width: 1.77, height: 1.46 } },
    { keywords: ['Civic 10', 'Civic 11', 'Civic Type R'], dimensions: { length: 4.55, width: 1.80, height: 1.42 } },
    { keywords: ['Focus Mk2'], dimensions: { length: 4.34, width: 1.84, height: 1.50 } },
    { keywords: ['Focus Mk3'], dimensions: { length: 4.36, width: 1.82, height: 1.48 } },
    { keywords: ['Focus Mk4', 'Focus ST'], dimensions: { length: 4.38, width: 1.83, height: 1.47 } },
    { keywords: ['Fiesta Mk6'], dimensions: { length: 3.95, width: 1.72, height: 1.48 } },
    { keywords: ['Fiesta Mk7', 'Fiesta ST'], dimensions: { length: 4.04, width: 1.74, height: 1.48 } },
    { keywords: ['Yaris GR'], dimensions: { length: 4.00, width: 1.81, height: 1.46 } },
    { keywords: ['Yaris Hybrid'], dimensions: { length: 3.94, width: 1.75, height: 1.50 } },
    { keywords: ['Corolla Hatchback', 'Corolla Hybrid'], dimensions: { length: 4.37, width: 1.79, height: 1.44 } },
    { keywords: ['Corolla Touring Sports'], dimensions: { length: 4.65, width: 1.79, height: 1.44 } },
    { keywords: ['308 GTi', '308 SW'], dimensions: { length: 4.37, width: 1.80, height: 1.44 } },
    { keywords: ['208 GT', '208 GTi'], dimensions: { length: 4.06, width: 1.75, height: 1.43 } },
    { keywords: ['206 CC'], dimensions: { length: 3.84, width: 1.67, height: 1.37 } },
    { keywords: ['207 SW'], dimensions: { length: 4.16, width: 1.75, height: 1.53 } },
    { keywords: ['A1 Sportback'], dimensions: { length: 4.03, width: 1.74, height: 1.41 } },
    { keywords: ['A3 Sportback', 'A3 Sedan', 'RS3', 'S3'], dimensions: { length: 4.34, width: 1.82, height: 1.45 } },
    { keywords: ['A4 Avant', 'S4', 'RS4 Avant'], dimensions: { length: 4.76, width: 1.85, height: 1.43 } },
    { keywords: ['A5 Sportback', 'S5', 'RS5'], dimensions: { length: 4.76, width: 1.84, height: 1.39 } },
    { keywords: ['A6 Avant', 'A7 Sportback', 'RS6 Avant', 'RS7'], dimensions: { length: 4.95, width: 1.89, height: 1.46 } },
    { keywords: ['A-Class Sedan', 'AMG A 45'], dimensions: { length: 4.55, width: 1.80, height: 1.45 } },
    { keywords: ['C-Class Estate', 'AMG C 63'], dimensions: { length: 4.75, width: 1.84, height: 1.46 } },
    { keywords: ['E-Class Estate'], dimensions: { length: 4.95, width: 1.88, height: 1.47 } },
    { keywords: ['S-Class Maybach'], dimensions: { length: 5.47, width: 1.92, height: 1.51 } },
    { keywords: ['Model 3 Long Range', 'Model 3 Performance'], dimensions: { length: 4.69, width: 1.85, height: 1.44 } },
    { keywords: ['Model S Plaid'], dimensions: { length: 4.98, width: 1.96, height: 1.45 } },
    { keywords: ['Model X Plaid'], dimensions: { length: 5.04, width: 2.00, height: 1.68 } },
    { keywords: ['Model Y Long Range', 'Model Y Performance'], dimensions: { length: 4.75, width: 1.92, height: 1.62 } },
    { keywords: ['compact electric', 'Atto 3', 'Dolphin', '4 Electric', '5 Electric', 'Leaf e+', 'C40 Recharge', 'XC40 Recharge', 'ZS EV', 'VF 6', 'VF 7'], dimensions: { length: 4.35, width: 1.82, height: 1.58 } },
    { keywords: ['Plug-in Hybrid', 'PHEV', 'Hybrid', 'e:HEV', 'e-Boxer', 'Recharge', 'E-Tech', 'iV'], dimensions: { length: 4.50, width: 1.84, height: 1.55 } },
    { keywords: ['Sportwagon', 'Sportswagon', 'SportCombi', 'Sportbrake', 'Sport Turismo', 'Touring', 'Tourer', 'Wagon', 'Estate', 'Combi', 'SW', 'Variant'], dimensions: { length: 4.70, width: 1.84, height: 1.50 } },
    { keywords: ['Cabriolet', 'Convertible', 'Volante', 'Roadster', 'Spyder', 'Cielo', 'GTS'], dimensions: { length: 4.35, width: 1.85, height: 1.35 } },
    { keywords: ['Coupe', 'Gran Coupe', 'Shooting Brake', 'Fastback'], dimensions: { length: 4.60, width: 1.84, height: 1.42 } },
    { keywords: ['GTI', 'GTD', 'GTE', 'Type R', 'ST', 'RS', 'AMG', 'M Sport', 'Quadrifoglio', 'VZ', 'N Line', 'Nismo', 'John Cooper Works', 'Brabus'], dimensions: { length: 4.35, width: 1.82, height: 1.45 } },
    { keywords: ['Double Cab', 'Crew Cab', 'Space Cab', 'Raptor', 'Rebel', 'TRX', 'Power Wagon', 'X-Terrain', 'Poer', 'Wingle'], dimensions: { length: 5.35, width: 1.92, height: 1.85 } },
    { keywords: ['Long', 'XL', 'LWB', 'EWB', 'ESV', 'Grand', 'Extended', 'Maxi'], dimensions: { length: 5.10, width: 1.95, height: 1.85 } },
    { keywords: ['SUV', 'Crossover', 'Cross', 'Trailhawk', 'Rubicon', 'Sahara', 'Allspace', '4x4', '4WD', 'AWD', 'xDrive'], dimensions: { length: 4.65, width: 1.88, height: 1.68 } },
    { keywords: ['Electric', 'EV', 'E-Tense', 'Folgore', 'Long Range', 'Performance'], dimensions: { length: 4.65, width: 1.88, height: 1.55 } },
    { keywords: ['500', '595', '695', 'Aygo', 'C1', 'Celerio', 'Citigo', 'Forfour', 'Fortwo', 'i10', 'Mii', 'Panda', 'Picanto', 'Seagull', 'Smart', 'Twingo', 'Up'], dimensions: { length: 3.60, width: 1.65, height: 1.50 } },
    { keywords: ['A1', 'C2', 'C3', 'Clio', 'Corsa', 'Fiesta', 'i20', 'Ibiza', 'Jazz', 'Micra', 'Polo', 'Rio', 'Sandero', 'Swift', 'Yaris'], dimensions: { length: 4.05, width: 1.75, height: 1.50 } },
    { keywords: ['A3', 'Astra', 'Ceed', 'Civic', 'Corolla', 'Focus', 'Golf', 'i30', 'Leon', 'Megane', 'Octavia', 'Tipo'], dimensions: { length: 4.40, width: 1.80, height: 1.48 } },
    { keywords: ['A4', 'Accord', 'Avensis', 'C-Class', 'Camry', 'E-Class', 'Giulia', 'Insignia', 'Mondeo', 'Passat', 'S60', 'Sonata', 'Talisman'], dimensions: { length: 4.80, width: 1.85, height: 1.45 } },
    { keywords: ['A6', 'A7', 'A8', '7 Series', '8 Series', 'CT5', 'Flying Spur', 'G80', 'G90', 'LS', 'Panamera', 'Quattroporte', 'S-Class', 'S90'], dimensions: { length: 5.10, width: 1.92, height: 1.48 } },
    { keywords: ['2008', '3008', '5008', 'Arona', 'Ateca', 'Bayon', 'C-HR', 'Captur', 'Crossland', 'Duster', 'EcoSport', 'HR-V', 'Juke', 'Kamiq', 'Karoq', 'Kona', 'Mokka', 'Q2', 'Q3', 'T-Cross', 'T-Roc', 'Tiguan', 'Tucson', 'Vitara', 'X1', 'X3', 'Yaris Cross'], dimensions: { length: 4.45, width: 1.85, height: 1.62 } },
    { keywords: ['Cayenne', 'Cherokee', 'Discovery', 'Explorer', 'Grand Cherokee', 'Highlander', 'Kodiaq', 'Koleos', 'Land Cruiser', 'Outlander', 'Pajero', 'Patrol', 'Q5', 'Q7', 'RAV4', 'Santa Fe', 'Sorento', 'Touareg', 'X5', 'X6', 'XC60', 'XC90'], dimensions: { length: 4.85, width: 1.95, height: 1.75 } },
    { keywords: ['Bentayga', 'Cullinan', 'Defender', 'Escalade', 'G-Class', 'GLS', 'H2', 'H3', 'Navigator', 'Range Rover', 'Tahoe', 'Urus', 'X7', 'Yukon'], dimensions: { length: 5.15, width: 2.00, height: 1.90 } },
    { keywords: ['Amarok', 'D-Max', 'Gladiator', 'Hilux', 'L200', 'Navara', 'Ranger', 'Sierra', 'Silverado', 'Wingle'], dimensions: { length: 5.30, width: 1.90, height: 1.80 } },
    { keywords: ['Berlingo', 'Caddy', 'Combo', 'Doblo', 'Dokker', 'Kangoo', 'Partner', 'Rifter'], dimensions: { length: 4.50, width: 1.85, height: 1.82 } },
    { keywords: ['Crafter', 'Ducato', 'Jumpy', 'ProMaster', 'Proace', 'Scudo', 'Sprinter', 'Trafic', 'Transit', 'Transporter', 'Vito'], dimensions: { length: 5.30, width: 1.95, height: 2.05 } },
    { keywords: ['Caravan', 'Carnival', 'Espace', 'Galaxy', 'Grand Voyager', 'Odyssey', 'Pacifica', 'S-Max', 'Sharan', 'Traveller', 'V-Class', 'Viano', 'Voyager', 'Zafira'], dimensions: { length: 4.90, width: 1.90, height: 1.75 } },
    { keywords: ['124 Spider', '296', '370Z', '4C', '718', '812', '911', 'Aventador', 'Boxster', 'BRZ', 'Camaro', 'Corvette', 'F-Type', 'Gallardo', 'Huracan', 'MX-5', 'Mustang', 'R8', 'Roadster', 'SF90', 'Supra', 'TT', 'Vantage'], dimensions: { length: 4.40, width: 1.90, height: 1.30 } },
];

const formatDimension = (value) => Number(value).toFixed(2);

const escapeRegExp = (value) => value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

const modelMatchesKeyword = (model, keyword) => {
    const pattern = new RegExp(`(^|[^a-z0-9])${escapeRegExp(keyword.toLowerCase())}($|[^a-z0-9])`);
    return pattern.test(model);
};

const normalizeDimensionKey = (value) => value
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, ' ')
    .trim();

const getExactVehicleDimensions = (brand, model) => {
    const brandDimensions = vehicleDimensionsByBrandModel[brand];

    if (!brandDimensions) {
        return null;
    }

    const normalizedModel = normalizeDimensionKey(model);
    const exactModel = Object.entries(brandDimensions)
        .find(([knownModel]) => normalizeDimensionKey(knownModel) === normalizedModel);

    if (exactModel) {
        return exactModel[1];
    }

    const parentModel = Object.entries(brandDimensions)
        .sort(([firstModel], [secondModel]) => secondModel.length - firstModel.length)
        .find(([knownModel]) => normalizedModel.startsWith(normalizeDimensionKey(knownModel)));

    return parentModel?.[1] || null;
};

const getGenerationModelForYear = (brand, model, year) => {
    const numericYear = Number(year);
    const brandRules = vehicleGenerationRules[brand];

    if (!brandRules || !Number.isInteger(numericYear)) {
        return null;
    }

    const matchingModel = Object.entries(brandRules)
        .find(([baseModel]) => normalizeDimensionKey(baseModel) === normalizeDimensionKey(model));

    if (!matchingModel) {
        return null;
    }

    const generation = matchingModel[1]
        .find(({ from, to }) => numericYear >= from && numericYear <= to);

    return generation?.model || null;
};

const getVehicleDimensions = (brand, model, year = null) => {
    const generationModel = getGenerationModelForYear(brand, model, year);
    const modelForDimensions = generationModel || model;
    const exactDimensions = getExactVehicleDimensions(brand, modelForDimensions);

    if (exactDimensions) {
        return exactDimensions;
    }

    const searchableModel = `${brand} ${modelForDimensions}`.toLowerCase();
    const profile = vehicleDimensionProfiles.find(({ keywords }) =>
        keywords.some((keyword) => modelMatchesKeyword(searchableModel, keyword)),
    );

    return profile?.dimensions || defaultVehicleDimensions;
};

const formatStorageDate = (date) => {
    const localDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);

    return localDate.toISOString().slice(0, 10);
};

const parseDisplayDate = (value) => {
    const match = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(value.trim());

    if (!match) {
        return null;
    }

    const [, day, month, year] = match;
    const date = new Date(Number(year), Number(month) - 1, Number(day));

    if (
        date.getFullYear() !== Number(year)
        || date.getMonth() !== Number(month) - 1
        || date.getDate() !== Number(day)
    ) {
        return null;
    }

    return date;
};

const setTodayAsMinimumDate = () => {
    const today = formatStorageDate(new Date());
    document.querySelectorAll('[data-travel-date]').forEach((input) => {
        input.min = today;
        if (!input.value) {
            input.value = today;
        }
    });
};

const fillSelect = (select, options, placeholder) => {
    const selectedValue = select.dataset.selectedValue || '';

    select.replaceChildren(new Option(placeholder, ''));
    options.forEach((option) => {
        const item = new Option(option, option);
        item.selected = selectedValue === option;
        select.add(item);
    });

    const other = new Option('Other', 'Other');
    other.selected = selectedValue === 'Other';
    select.add(other);
};

const getAvailableModelYears = (brand, model) => {
    const brandRules = vehicleGenerationRules[brand];
    const currentYear = new Date().getFullYear() + 1;

    if (!brandRules || !model || model === 'Other') {
        return [];
    }

    const normalizedModel = normalizeDimensionKey(model);
    const directRules = Object.entries(brandRules)
        .find(([baseModel]) => normalizeDimensionKey(baseModel) === normalizedModel)?.[1];

    const matchingRules = directRules || Object.values(brandRules)
        .flat()
        .filter((rule) => normalizeDimensionKey(rule.model) === normalizedModel);

    if (matchingRules.length) {
        const years = new Set();

        matchingRules.forEach(({ from, to }) => {
            for (let year = Math.min(to, currentYear); year >= from; year -= 1) {
                years.add(year);
            }
        });

        return [...years].sort((firstYear, secondYear) => secondYear - firstYear);
    }

    // A version such as "Golf GTI" or "Focus ST" inherits only the production
    // years of its verified parent generation when no dedicated range is listed.
    const parentRules = Object.entries(brandRules)
        .find(([baseModel]) => normalizedModel.startsWith(`${normalizeDimensionKey(baseModel)} `))?.[1];

    if (!parentRules?.length) {
        return [];
    }

    const years = new Set();

    parentRules.forEach(({ from, to }) => {
        for (let year = Math.min(to, currentYear); year >= from; year -= 1) {
            years.add(year);
        }
    });

    return [...years].sort((firstYear, secondYear) => secondYear - firstYear);
};

const fillYearSelect = (select, brand = '', model = '') => {
    const selectedYear = select.dataset.selectedYear || '';
    const years = getAvailableModelYears(brand, model);
    const placeholder = brand && model
        ? (years.length ? 'Select year' : 'Year not found')
        : 'Select year';

    select.replaceChildren(new Option(placeholder, ''));

    years.forEach((year) => {
        const option = new Option(String(year), String(year));
        option.selected = selectedYear === String(year);
        select.add(option);
    });

    select.disabled = years.length === 0;

    return years;
};

const vehicleSpecificationUrl = (endpoint, parameters) => {
    const query = new URLSearchParams(parameters);
    return `/vehicle-specifications/${endpoint}?${query.toString()}`;
};

const fetchVehicleSpecification = async (endpoint, parameters) => {
    const response = await fetch(vehicleSpecificationUrl(endpoint, parameters), {
        headers: { Accept: 'application/json' },
    });

    if (!response.ok) {
        throw new Error('Vehicle specification request failed.');
    }

    return response.json();
};

document.addEventListener('DOMContentLoaded', () => {
    const reservationSuccessModal = document.querySelector('[data-reservation-success-modal]');

    if (reservationSuccessModal) {
        const closeReservationSuccessModal = () => {
            if (typeof reservationSuccessModal.close === 'function') {
                reservationSuccessModal.close();
            } else {
                reservationSuccessModal.removeAttribute('open');
            }
        };

        if (typeof reservationSuccessModal.showModal === 'function' && !reservationSuccessModal.open) {
            reservationSuccessModal.showModal();
        } else {
            reservationSuccessModal.setAttribute('open', '');
        }

        reservationSuccessModal.querySelectorAll('[data-reservation-success-close]').forEach((button) => {
            button.addEventListener('click', closeReservationSuccessModal);
        });

        reservationSuccessModal.addEventListener('click', (event) => {
            if (event.target === reservationSuccessModal) {
                closeReservationSuccessModal();
            }
        });
    }

    const statusModal = document.querySelector('[data-status-modal]');

    if (statusModal) {
        const statusInput = statusModal.querySelector('[data-status-input]');
        const statusLabel = statusModal.querySelector('[data-status-modal-label]');

        document.querySelectorAll('[data-status-button]').forEach((button) => {
            button.addEventListener('click', () => {
                statusInput.value = button.dataset.statusValue;
                statusLabel.textContent = button.dataset.statusLabel;
                statusModal.showModal();
            });
        });

        statusModal.querySelectorAll('[data-status-modal-close]').forEach((button) => {
            button.addEventListener('click', () => statusModal.close());
        });
    }

    const form = document.querySelector('#ctn-reservation-form');

    if (!form) {
        return;
    }

    form.noValidate = true;
    setTodayAsMinimumDate();

    const returnDate = form.querySelector('[data-return-date]');
    const returnDateInput = form.querySelector('#return_date');
    const returnPassengers = form.querySelectorAll('[data-return-passenger]');
    const returnPassengerLabel = form.querySelector('[data-return-column-label]');
    const trailerReturn = form.querySelector('[data-trailer-return]');
    const passengerDetailsWrapper = form.querySelector('[data-passenger-details-wrapper]');
    const passengerDetails = form.querySelector('[data-passenger-details]');
    const inputClass =
        'mt-2 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-950 outline-none focus:border-slate-950 focus:ring-2 focus:ring-slate-200';
    const invalidFieldClasses = ['border-red-500', 'focus:border-red-600', 'focus:ring-red-100'];
    const readJsonScript = (id) => {
        const script = document.getElementById(id);

        if (!script?.textContent.trim()) {
            return {};
        }

        try {
            return JSON.parse(script.textContent);
        } catch {
            return {};
        }
    };
    const serverErrors = readJsonScript('ctn-validation-errors');
    const oldInput = readJsonScript('ctn-old-input');
    const oldFieldValues = {};
    const flattenOldInput = (value, prefix = '') => {
        if (value === null || typeof value !== 'object' || Array.isArray(value) && value.every((item) => item === null || typeof item !== 'object')) {
            oldFieldValues[prefix] = value ?? '';

            return;
        }

        Object.entries(value).forEach(([key, nestedValue]) => {
            flattenOldInput(nestedValue, prefix ? `${prefix}[${key}]` : key);
        });
    };
    Object.entries(oldInput).forEach(([key, value]) => flattenOldInput(value, key));

    const fieldLabel = (field) => {
        if (field.id) {
            const label = form.querySelector(`label[for="${CSS.escape(field.id)}"]`);

            if (label?.textContent.trim()) {
                return label.textContent.trim();
            }
        }

        return field.placeholder || field.name.replace(/[_\[\]]+/g, ' ').trim() || 'This field';
    };

    const validationMessageFor = (field) => {
        const label = fieldLabel(field);

        if (field.validity.valueMissing) {
            return `${label} is required.`;
        }

        if (field.validity.typeMismatch) {
            return `Enter a valid ${label.toLowerCase()}.`;
        }

        if (field.validity.patternMismatch) {
            return `${label} has an invalid format.`;
        }

        if (field.validity.rangeUnderflow) {
            return `${label} must be greater than or equal to ${field.min}.`;
        }

        if (field.validity.rangeOverflow) {
            return `${label} must be less than or equal to ${field.max}.`;
        }

        if (field.validity.stepMismatch) {
            return `${label} must match the requested step.`;
        }

        if (field.validity.tooLong) {
            return `${label} is too long.`;
        }

        if (field.validity.customError) {
            return field.validationMessage;
        }

        return field.validationMessage || `${label} is invalid.`;
    };

    const errorAnchorFor = (field) => {
        if (field.type === 'checkbox' || field.type === 'radio') {
            return field.closest('label') || field;
        }

        return field;
    };

    const clearFieldError = (field) => {
        field.removeAttribute('aria-invalid');
        field.classList.remove(...invalidFieldClasses);

        const describedBy = (field.getAttribute('aria-describedby') || '')
            .split(/\s+/)
            .filter((id) => id && id !== field.dataset.validationErrorId)
            .join(' ');

        if (describedBy) {
            field.setAttribute('aria-describedby', describedBy);
        } else {
            field.removeAttribute('aria-describedby');
        }

        if (field.dataset.validationErrorId) {
            document.getElementById(field.dataset.validationErrorId)?.remove();
            delete field.dataset.validationErrorId;
        }
    };

    const showFieldError = (field, message) => {
        clearFieldError(field);

        const anchor = errorAnchorFor(field);
        const existingError = anchor.nextElementSibling;

        if (existingError?.tagName === 'P' && existingError.textContent.trim() === message) {
            const errorId = existingError.id || `${field.id || field.name.replace(/[^a-z0-9]+/gi, '-')}-error-existing`;

            existingError.id = errorId;
            field.dataset.validationErrorId = errorId;
            field.setAttribute('aria-invalid', 'true');
            field.setAttribute('aria-describedby', [field.getAttribute('aria-describedby'), errorId].filter(Boolean).join(' '));

            if (field.matches('.ui-input') || field.tagName === 'SELECT' || field.tagName === 'TEXTAREA') {
                field.classList.add(...invalidFieldClasses);
            }

            return;
        }

        const error = document.createElement('p');
        const errorId = `${field.id || field.name.replace(/[^a-z0-9]+/gi, '-')}-error-${Math.random().toString(36).slice(2, 8)}`;

        error.id = errorId;
        error.className = 'mt-2 text-sm font-semibold text-red-600';
        error.dataset.validationError = '';
        error.textContent = message;

        field.dataset.validationErrorId = errorId;
        field.setAttribute('aria-invalid', 'true');
        field.setAttribute('aria-describedby', [field.getAttribute('aria-describedby'), errorId].filter(Boolean).join(' '));

        if (field.matches('.ui-input') || field.tagName === 'SELECT' || field.tagName === 'TEXTAREA') {
            field.classList.add(...invalidFieldClasses);
        }

        anchor.insertAdjacentElement('afterend', error);
    };

    const errorKeysFor = (field) => {
        const keys = [field.name];
        const bracketKey = field.name.replace(/\]/g, '').replace(/\[/g, '.');

        keys.push(bracketKey);

        if (field.name.endsWith('[]')) {
            const fields = [...form.querySelectorAll(`[name="${CSS.escape(field.name)}"]`)];
            const index = fields.indexOf(field);
            keys.push(`${field.name.slice(0, -2)}.${index}`);
        }

        return keys;
    };

    const renderServerErrors = () => {
        form.querySelectorAll('input, select, textarea').forEach((field) => {
            if (field.disabled || field.type === 'hidden' || field.closest('[hidden]')) {
                return;
            }

            const errorKey = errorKeysFor(field).find((key) => serverErrors[key]?.length);

            if (errorKey) {
                showFieldError(field, serverErrors[errorKey][0]);
            }
        });
    };

    const validateVisibleFields = () => {
        let firstInvalidField = null;

        form.querySelectorAll('[data-validation-error]').forEach((error) => error.remove());
        form.querySelectorAll('input, select, textarea').forEach(clearFieldError);
        validateDateInputs();

        form.querySelectorAll('input, select, textarea').forEach((field) => {
            if (field.disabled || field.type === 'hidden' || field.closest('[hidden]')) {
                return;
            }

            if (!field.checkValidity()) {
                firstInvalidField ||= field;
                showFieldError(field, validationMessageFor(field));
            }
        });

        return firstInvalidField;
    };

    const getPassengerDetailValues = () => {
        const values = { ...oldFieldValues };
        passengerDetails.querySelectorAll('input, select').forEach((field) => {
            values[field.name] = field.value;
        });
        return values;
    };

    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    const maximumPassportDate = new Date(today.getFullYear() + 10, 11, 31);

    const dateAttributesForField = (name) => {
        if (!name.includes('[passport_availability_date]')) {
            return `max="${formatStorageDate(today)}"`;
        }

        return `min="${formatStorageDate(tomorrow)}" max="${formatStorageDate(maximumPassportDate)}"`;
    };

    const dateInputValue = (value) => {
        if (/^\d{4}-\d{2}-\d{2}$/.test(value)) {
            return value;
        }

        const parsedDate = parseDisplayDate(value);

        return parsedDate ? formatStorageDate(parsedDate) : value;
    };

    const validateDateInput = (input) => {
        if (input.type !== 'date') {
            return true;
        }

        if (input.disabled) {
            input.setCustomValidity('');

            return true;
        }

        if (input.value && input.min && input.value < input.min) {
            input.setCustomValidity('Choose a later date.');

            return false;
        }

        if (input.value && input.max && input.value > input.max) {
            input.setCustomValidity('Choose an earlier date.');

            return false;
        }

        input.setCustomValidity('');

        return true;
    };

    const validateDateInputs = () => {
        const outwardInput = form.querySelector('#outward_date');
        const returnInput = form.querySelector('#return_date');
        let valid = true;

        form.querySelectorAll('input[type="date"]').forEach((input) => {
            valid = validateDateInput(input) && valid;
        });

        if (!returnInput?.disabled && outwardInput?.value && returnInput?.value) {
            if (returnInput.value < outwardInput.value) {
                returnInput.setCustomValidity('Return date must be after or equal to outward date.');
                valid = false;
            }
        }

        return valid;
    };

    const createField = (type, label, name, value = '') => {
        const wrapper = document.createElement('div');
        const id = name.replace(/[\[\]]+/g, '_').replace(/_$/, '');
        const inputMarkup =
            type === 'select'
                ? `<select id="${id}" name="${name}" required class="${inputClass}">
                    <option value="">Select</option>
                    <option value="male"${value === 'male' ? ' selected' : ''}>Male</option>
                    <option value="female"${value === 'female' ? ' selected' : ''}>Female</option>
                </select>`
                : `<input id="${id}" name="${name}" type="${type}" value="${type === 'date' ? dateInputValue(value) : value}" required ${type === 'date' ? dateAttributesForField(name) : ''} class="${inputClass}">`;

        wrapper.innerHTML = `
            <label for="${id}" class="block text-sm font-medium text-slate-800">${label}</label>
            ${inputMarkup}
        `;

        return wrapper;
    };

    const createReturnPassengerChoice = (prefix, existingValues) => {
        const value = existingValues[`${prefix}[will_return]`] || 'yes';
        const wrapper = document.createElement('div');
        wrapper.className = 'mt-4 rounded-md border border-primary-100 bg-primary-50 p-3';

        wrapper.innerHTML = `
            <p class="text-sm font-semibold text-slate-900">Will this outward passenger return?</p>
            <div class="mt-3 grid gap-2 sm:grid-cols-2">
                <label class="flex items-center gap-2 text-sm font-medium text-slate-800">
                    <input type="radio" name="${prefix}[will_return]" value="yes" data-will-return-toggle${value !== 'no' ? ' checked' : ''}>
                    Yes
                </label>
                <label class="flex items-center gap-2 text-sm font-medium text-slate-800">
                    <input type="radio" name="${prefix}[will_return]" value="no" data-will-return-toggle${value === 'no' ? ' checked' : ''}>
                    No
                </label>
            </div>
        `;

        const replacement = document.createElement('div');
        replacement.className = 'mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3';
        replacement.dataset.returnReplacement = '';
        replacement.hidden = value !== 'no';
        replacement.append(
            createField(
                'text',
                'Return passenger last name',
                `${prefix}[return_replacement][last_name]`,
                existingValues[`${prefix}[return_replacement][last_name]`] || '',
            ),
            createField(
                'text',
                'Return passenger first name',
                `${prefix}[return_replacement][first_name]`,
                existingValues[`${prefix}[return_replacement][first_name]`] || '',
            ),
            createField(
                'date',
                'Return passenger date of birth',
                `${prefix}[return_replacement][date_of_birth]`,
                existingValues[`${prefix}[return_replacement][date_of_birth]`] || '',
            ),
            createField(
                'select',
                'Return passenger gender',
                `${prefix}[return_replacement][sexe]`,
                existingValues[`${prefix}[return_replacement][sexe]`] || '',
            ),
            createField(
                'text',
                'Return passenger passport number',
                `${prefix}[return_replacement][passport_number]`,
                existingValues[`${prefix}[return_replacement][passport_number]`] || '',
            ),
            createField(
                'date',
                'Return passenger passport availability date',
                `${prefix}[return_replacement][passport_availability_date]`,
                existingValues[`${prefix}[return_replacement][passport_availability_date]`] || '',
            ),
        );
        replacement.querySelectorAll('input, select').forEach((field) => {
            field.disabled = value !== 'no';
        });

        wrapper.append(replacement);

        return wrapper;
    };

    const isRoundTripSelected = () => form.querySelector('[name="journey_type"]:checked')?.value === 'round_trip';

    const renderPassengerDetails = () => {
        const existingValues = getPassengerDetailValues();
        const isRoundTrip = isRoundTripSelected();
        const fragment = document.createDocumentFragment();
        let passengerCount = 0;

        form.querySelectorAll('[data-passenger-row]').forEach((row, rowIndex) => {
            const category = row.dataset.passengerCategory;
            const outwardInput = row.querySelector('[name="outward_passengers[]"]');
            const returnInput = row.querySelector('[name="return_passengers[]"]');
            const outwardTotal = Math.max(0, Number(outwardInput.value || 0));
            const returnTotal = Math.max(0, Number(returnInput.value || 0));

            for (let index = 0; index < outwardTotal; index += 1) {
                passengerCount += 1;
                const prefix = `passenger_details[outward][${rowIndex}][${index}]`;
                const panel = document.createElement('div');
                panel.className = 'rounded-lg border border-slate-200 bg-white p-4 shadow-sm';

                const title = document.createElement('h4');
                title.className = 'text-sm font-semibold text-slate-950';
                title.textContent = `Outward - ${category} #${index + 1}`;

                const grid = document.createElement('div');
                grid.className = 'mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3';
                grid.append(
                    createField('text', 'Last name', `${prefix}[last_name]`, existingValues[`${prefix}[last_name]`] || ''),
                    createField('text', 'First name', `${prefix}[first_name]`, existingValues[`${prefix}[first_name]`] || ''),
                    createField('date', 'Date of birth', `${prefix}[date_of_birth]`, existingValues[`${prefix}[date_of_birth]`] || ''),
                    createField('select', 'Gender', `${prefix}[sexe]`, existingValues[`${prefix}[sexe]`] || ''),
                    createField('text', 'Passport number', `${prefix}[passport_number]`, existingValues[`${prefix}[passport_number]`] || ''),
                    createField('date', 'Passport availability date', `${prefix}[passport_availability_date]`, existingValues[`${prefix}[passport_availability_date]`] || ''),
                );

                panel.append(title, grid);

                if (isRoundTrip && index < returnTotal) {
                    panel.append(createReturnPassengerChoice(prefix, existingValues));
                }

                fragment.append(panel);
            }

            if (isRoundTrip && returnTotal > outwardTotal) {
                for (let index = outwardTotal; index < returnTotal; index += 1) {
                    passengerCount += 1;
                    const returnOnlyIndex = index - outwardTotal;
                    const prefix = `passenger_details[return_extra][${rowIndex}][${returnOnlyIndex}]`;
                    const panel = document.createElement('div');
                    panel.className = 'rounded-lg border border-slate-200 bg-white p-4 shadow-sm';

                    const title = document.createElement('h4');
                    title.className = 'text-sm font-semibold text-slate-950';
                    title.textContent = `Return only - ${category} #${returnOnlyIndex + 1}`;

                    const grid = document.createElement('div');
                    grid.className = 'mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3';
                    grid.append(
                        createField('text', 'Last name', `${prefix}[last_name]`, existingValues[`${prefix}[last_name]`] || ''),
                        createField('text', 'First name', `${prefix}[first_name]`, existingValues[`${prefix}[first_name]`] || ''),
                        createField('date', 'Date of birth', `${prefix}[date_of_birth]`, existingValues[`${prefix}[date_of_birth]`] || ''),
                        createField('select', 'Gender', `${prefix}[sexe]`, existingValues[`${prefix}[sexe]`] || ''),
                        createField('text', 'Passport number', `${prefix}[passport_number]`, existingValues[`${prefix}[passport_number]`] || ''),
                        createField('date', 'Passport availability date', `${prefix}[passport_availability_date]`, existingValues[`${prefix}[passport_availability_date]`] || ''),
                    );

                    panel.append(title, grid);
                    fragment.append(panel);
                }
            }
        });

        passengerDetails.replaceChildren(fragment);
        passengerDetailsWrapper.hidden = passengerCount === 0;
    };

    const syncJourneyType = () => {
        const isRoundTrip = isRoundTripSelected();
        [returnDate, returnPassengerLabel, trailerReturn].forEach((element) => {
            if (element) {
                element.hidden = !isRoundTrip;
            }
        });
        returnPassengers.forEach((element) => {
            element.hidden = !isRoundTrip;
            element.querySelectorAll('input, button').forEach((field) => {
                field.disabled = !isRoundTrip;
            });
        });
        if (returnDateInput) {
            returnDateInput.required = isRoundTrip;
            returnDateInput.disabled = !isRoundTrip;
            returnDateInput.setCustomValidity('');
        }
        renderPassengerDetails();
    };

    form.querySelectorAll('[name="journey_type"]').forEach((radio) => {
        radio.addEventListener('change', syncJourneyType);
    });
    syncJourneyType();

    form.querySelectorAll('[data-counter-minus], [data-counter-plus]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('input[type="number"]');
            const step = button.matches('[data-counter-plus]') ? 1 : -1;
            input.value = Math.max(Number(input.min || 0), Number(input.value || 0) + step);
            renderPassengerDetails();
        });
    });

    form.querySelectorAll('[name="outward_passengers[]"], [name="return_passengers[]"]').forEach((input) => {
        input.addEventListener('input', () => {
            renderPassengerDetails();
        });
    });

    form.addEventListener('input', (event) => {
        if (event.target instanceof HTMLInputElement) {
            validateDateInput(event.target);
        }

        if (event.target instanceof HTMLInputElement || event.target instanceof HTMLSelectElement || event.target instanceof HTMLTextAreaElement) {
            clearFieldError(event.target);
        }
    });

    form.addEventListener('change', (event) => {
        if (event.target instanceof HTMLInputElement || event.target instanceof HTMLSelectElement || event.target instanceof HTMLTextAreaElement) {
            clearFieldError(event.target);
        }
    });

    form.addEventListener('submit', (event) => {
        const firstInvalidField = validateVisibleFields();

        if (firstInvalidField) {
            event.preventDefault();
            firstInvalidField.focus({ preventScroll: true });
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });

            return;
        }

        const submitButton = form.querySelector('[data-reservation-submit]');

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.setAttribute('aria-busy', 'true');
        }
    });

    passengerDetails.addEventListener('change', (event) => {
        const toggle = event.target.closest('[data-will-return-toggle]');

        if (!toggle) {
            return;
        }

        const panel = toggle.closest('.rounded-lg');
        const replacement = panel?.querySelector('[data-return-replacement]');

        if (replacement) {
            replacement.hidden = toggle.value !== 'no';
            replacement.querySelectorAll('input, select').forEach((field) => {
                field.disabled = toggle.value !== 'no';
            });
        }
    });

    const brandSelect = form.querySelector('#vehicle_brand');
    const modelSelect = form.querySelector('#vehicle_model');
    const yearSelect = form.querySelector('#vehicle_year');
    const yearManualToggleWrapper = form.querySelector('[data-vehicle-year-manual-toggle-wrapper]');
    const yearManualToggle = form.querySelector('[data-vehicle-year-manual-toggle]');
    const yearManualWrapper = form.querySelector('[data-vehicle-year-manual]');
    const yearManualInput = form.querySelector('#vehicle_year_manual');
    const otherBrand = form.querySelector('[data-other-brand]');
    const otherModel = form.querySelector('[data-other-model]');
    const otherBrandInput = form.querySelector('#vehicle_brand_other');
    const otherModelInput = form.querySelector('#vehicle_model_other');
    const vehicleLengthInput = form.querySelector('[name="vehicle_length"]');
    const vehicleWidthInput = form.querySelector('[name="vehicle_width"]');
    const vehicleHeightInput = form.querySelector('[name="vehicle_height"]');
    const vehicleDimensionInputs = [vehicleLengthInput, vehicleWidthInput, vehicleHeightInput];
    const vehicleDimensionInputTargets = new Map([
        [vehicleLengthInput, 'length'],
        [vehicleWidthInput, 'width'],
        [vehicleHeightInput, 'height'],
    ]);
    const vehicleDimensionInputsByTarget = {
        length: vehicleLengthInput,
        width: vehicleWidthInput,
        height: vehicleHeightInput,
    };
    let yearRequestId = 0;
    let dimensionRequestId = 0;
    let isApplyingDimensionExtras = false;

    const parseDimension = (value) => Number(String(value || '0').replace(',', '.')) || 0;

    const getBaseDimension = (target) => {
        const input = vehicleDimensionInputsByTarget[target];

        return parseDimension(input.dataset.baseValue || input.value);
    };

    const getExtraDimensionValue = (target) => {
        const toggle = form.querySelector(`[data-extra-dimension-toggle][data-extra-dimension-target="${target}"]`);
        const select = form.querySelector(`[data-extra-dimension-select][data-extra-dimension-target="${target}"]`);

        if (!toggle?.checked || select?.disabled) {
            return 0;
        }

        return parseDimension(select.value);
    };

    const applyExtraDimensions = () => {
        isApplyingDimensionExtras = true;
        vehicleLengthInput.value = formatDimension(getBaseDimension('length') + getExtraDimensionValue('length'));
        vehicleWidthInput.value = formatDimension(getBaseDimension('width'));
        vehicleHeightInput.value = formatDimension(getBaseDimension('height') + getExtraDimensionValue('height'));
        isApplyingDimensionExtras = false;
    };

    const setBaseVehicleDimensions = ({ length, width, height }) => {
        vehicleLengthInput.dataset.baseValue = formatDimension(length);
        vehicleWidthInput.dataset.baseValue = formatDimension(width);
        vehicleHeightInput.dataset.baseValue = formatDimension(height);
        applyExtraDimensions();
    };

    const hasActiveDimensionExtras = () =>
        Boolean(form.querySelector('[data-extra-dimension-toggle]:checked'));

    const applyVehicleDimensions = async () => {
        const brand = brandSelect.value;
        const model = modelSelect.value;
        const year = yearManualInput.disabled ? yearSelect.value : yearManualInput.value;

        if (!brand || brand === 'Other' || !model || model === 'Other') {
            setBaseVehicleDimensions(defaultVehicleDimensions);
            return;
        }

        const dimensions = getVehicleDimensions(brand, model, year);
        setBaseVehicleDimensions(dimensions);

        if (getExactVehicleDimensions(brand, model)) {
            return;
        }

        if (!year) {
            return;
        }

        const requestId = ++dimensionRequestId;

        try {
            const result = await fetchVehicleSpecification('dimensions', { brand, model, year });
            const sourceDimensions = result.dimensions;

            if (
                requestId !== dimensionRequestId ||
                brand !== brandSelect.value ||
                model !== modelSelect.value ||
                String(year) !== (yearManualInput.disabled ? yearSelect.value : yearManualInput.value) ||
                !sourceDimensions
            ) {
                return;
            }

            setBaseVehicleDimensions(sourceDimensions);
        } catch {
            // The vetted local catalogue remains available when the source cannot be reached.
        }
    };

    const loadAvailableModelYears = async () => {
        const brand = brandSelect.value;
        const model = modelSelect.value;

        const fallbackYears = fillYearSelect(yearSelect, brand, model);
        syncManualVehicleYear(fallbackYears.length === 0);

        if (!brand || brand === 'Other' || !model || model === 'Other') {
            return;
        }

        const requestId = ++yearRequestId;
        yearSelect.replaceChildren(new Option('Searching model years...', ''));
        yearSelect.disabled = true;

        try {
            const result = await fetchVehicleSpecification('years', { brand, model });

            if (requestId !== yearRequestId || brand !== brandSelect.value || model !== modelSelect.value) {
                return;
            }

            // The external catalogue does not cover every market or historic model.
            // Never let an empty remote response erase locally verified generations.
            const fallbackYears = getAvailableModelYears(brand, model);
            const years = result.years?.length ? result.years : fallbackYears;
            yearSelect.replaceChildren(new Option(years.length ? 'Select year' : 'Year not found', ''));
            years.forEach((year) => yearSelect.add(new Option(String(year), String(year))));
            yearSelect.disabled = years.length === 0;
            syncManualVehicleYear(years.length === 0);
        } catch {
            if (requestId === yearRequestId) {
                const years = fillYearSelect(yearSelect, brand, model);
                syncManualVehicleYear(years.length === 0);
            }
        }
    };

    const syncManualVehicleYear = (yearNotFound = yearSelect.disabled) => {
        const hasSelectedVehicle = Boolean(brandSelect.value && modelSelect.value);
        const showManualToggle = hasSelectedVehicle;

        if (showManualToggle && yearNotFound) {
            yearManualToggle.checked = true;
        }

        if (!showManualToggle) {
            yearManualToggle.checked = false;
        }

        const showManualYear = showManualToggle && yearManualToggle.checked;

        yearManualToggleWrapper.hidden = !showManualToggle;
        yearManualWrapper.hidden = !showManualYear;
        yearManualInput.disabled = !showManualYear;
        yearSelect.disabled = showManualYear || yearNotFound || yearSelect.options.length <= 1;

        if (showManualYear) {
            yearSelect.value = '';
        } else {
            yearManualInput.value = '';
        }
    };

    const syncOtherVehicleFields = () => {
        const brandIsOther = brandSelect.value === 'Other';
        const modelIsOther = brandIsOther || modelSelect.value === 'Other';

        otherBrand.hidden = !brandIsOther;
        otherBrandInput.disabled = !brandIsOther;
        otherBrandInput.required = brandIsOther;

        otherModel.hidden = !modelIsOther;
        otherModelInput.disabled = !modelIsOther;
        otherModelInput.required = modelIsOther;
    };

    const applyStoredSelectValues = () => {
        form.querySelectorAll('select[data-selected-value]').forEach((select) => {
            if (select.dataset.selectedValue && [...select.options].some((option) => option.value === select.dataset.selectedValue)) {
                select.value = select.dataset.selectedValue;
            }
        });
    };

    fillYearSelect(yearSelect);
    syncManualVehicleYear(false);
    fillSelect(brandSelect, Object.keys(carCatalog).sort(), 'Select brand');
    if (brandSelect.value) {
        modelSelect.disabled = false;
        fillSelect(modelSelect, brandSelect.value === 'Other' ? [] : carCatalog[brandSelect.value] || [], 'Select model');
        if (brandSelect.value === 'Other') {
            modelSelect.value = 'Other';
        }
        if (modelSelect.value) {
            loadAvailableModelYears();
        }
    }
    applyStoredSelectValues();
    syncOtherVehicleFields();
    applyVehicleDimensions();

    brandSelect.addEventListener('change', () => {
        const brand = brandSelect.value;
        const brandIsOther = brand === 'Other';
        modelSelect.disabled = !brand;
        yearSelect.value = '';
        yearSelect.dataset.selectedYear = '';
        yearManualToggle.checked = false;
        yearManualInput.value = '';
        yearRequestId += 1;
        fillYearSelect(yearSelect);
        syncManualVehicleYear(false);
        fillSelect(modelSelect, brandIsOther ? [] : carCatalog[brand] || [], 'Select model');
        if (brandIsOther) {
            modelSelect.value = 'Other';
        }
        syncOtherVehicleFields();
        applyVehicleDimensions();
    });

    modelSelect.addEventListener('change', () => {
        syncOtherVehicleFields();
        yearSelect.value = '';
        yearSelect.dataset.selectedYear = '';
        yearManualToggle.checked = false;
        yearManualInput.value = '';
        loadAvailableModelYears();
        applyVehicleDimensions();
    });

    yearSelect.addEventListener('change', () => {
        applyVehicleDimensions();
    });

    yearManualInput.addEventListener('input', () => {
        yearManualInput.value = yearManualInput.value.replace(/\D/g, '').slice(0, 4);
        applyVehicleDimensions();
    });

    yearManualToggle.addEventListener('change', () => {
        syncManualVehicleYear(yearSelect.options.length <= 1);
        applyVehicleDimensions();
    });

    const vehicleDimensionsToggle = form.querySelector('[data-vehicle-dimensions-toggle]');
    const vehicleDimensions = form.querySelector('[data-vehicle-dimensions]');
    const syncVehicleDimensions = () => {
        if (hasActiveDimensionExtras() && !vehicleDimensionsToggle.checked) {
            vehicleDimensionsToggle.checked = true;
        }

        const hasCustomDimensions = vehicleDimensionsToggle.checked;
        vehicleDimensions.hidden = !hasCustomDimensions;
        vehicleDimensionInputs.forEach((input) => {
            input.disabled = !hasCustomDimensions;
            input.required = hasCustomDimensions;
        });
    };

    vehicleDimensionsToggle.addEventListener('change', syncVehicleDimensions);
    syncVehicleDimensions();

    const ensureVehicleDimensionsVisible = () => {
        if (!vehicleDimensionsToggle.checked) {
            vehicleDimensionsToggle.checked = true;
            syncVehicleDimensions();
        }
    };

    const roofBoxToggle = form.querySelector('[data-roof-box-toggle]');
    const roofBoxPanel = form.querySelector('[data-roof-box-panel]');
    const extraDimensionToggles = form.querySelectorAll('[data-extra-dimension-toggle]');
    const extraDimensionSelects = form.querySelectorAll('[data-extra-dimension-select]');

    const syncExtraDimensionControls = () => {
        extraDimensionToggles.forEach((toggle) => {
            const target = toggle.dataset.extraDimensionTarget;
            const wrapper = form.querySelector(`[data-extra-dimension-select-wrapper="${target}"]`);
            const select = form.querySelector(`[data-extra-dimension-select][data-extra-dimension-target="${target}"]`);
            const showSelect = roofBoxToggle.checked && toggle.checked;

            wrapper.hidden = !showSelect;
            select.disabled = !showSelect;

            if (showSelect) {
                ensureVehicleDimensionsVisible();
            }
        });

        applyExtraDimensions();
    };

    const syncRoofBox = () => {
        const hasRoofBox = roofBoxToggle.checked;
        roofBoxPanel.hidden = !hasRoofBox;

        if (!hasRoofBox) {
            extraDimensionToggles.forEach((toggle) => {
                toggle.checked = false;
            });
        }

        syncExtraDimensionControls();
    };

    vehicleDimensionInputs.forEach((input) => {
        input.addEventListener('input', () => {
            if (isApplyingDimensionExtras) {
                return;
            }

            const target = vehicleDimensionInputTargets.get(input);
            input.dataset.baseValue = formatDimension(Math.max(0, parseDimension(input.value) - getExtraDimensionValue(target)));
            applyExtraDimensions();
        });
    });

    roofBoxToggle.addEventListener('change', syncRoofBox);
    extraDimensionToggles.forEach((toggle) => toggle.addEventListener('change', syncExtraDimensionControls));
    extraDimensionSelects.forEach((select) => select.addEventListener('change', applyExtraDimensions));
    applyStoredSelectValues();
    syncRoofBox();

    const trailerToggle = form.querySelector('[data-trailer-toggle]');
    const trailerPanel = form.querySelector('[data-trailer-panel]');
    const trailerTypeRadios = form.querySelectorAll('[name="trailer_type"]');
    const trailerDimensionInputs = form.querySelectorAll('[name="trailer_length"], [name="trailer_height"], [name="trailer_width"]');
    const syncTrailer = () => {
        const hasTrailer = trailerToggle.checked;
        trailerPanel.hidden = !hasTrailer;
        const hasSelectedTrailerType = [...trailerTypeRadios].some((radio) => radio.checked);

        trailerTypeRadios.forEach((radio, index) => {
            radio.disabled = !hasTrailer;
            radio.required = hasTrailer;
            radio.checked = hasTrailer && (hasSelectedTrailerType ? radio.checked : index === 0);
        });
        trailerDimensionInputs.forEach((input) => {
            input.disabled = !hasTrailer;
            input.required = hasTrailer;
        });
    };
    trailerToggle.addEventListener('change', syncTrailer);
    syncTrailer();

    renderPassengerDetails();
    renderServerErrors();
});
