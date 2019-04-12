@extends('layouts.app')

@section('content')

	<div id="root">

    	<div class="row">
    	    <div class="col-md-3">
        		@include('dashboard2.activity')
            </div>
    		<div class="col-md-4">
    
    		</div>
    		<div class="col-md-5">
    
            </div>
         </div>
         <div class="row">
    	    <div class="col-md-3">
    	    	@include('dashboard2.deliverables')
            </div>
    		<div class="col-md-3">
    			@include('dashboard2.publications')
    		</div>
    		<div class="col-md-3">
    			@include('dashboard2.documents')
            </div>
            <div class="col-md-3">
    			@include('dashboard2.contacts')
            </div>
        </div>
        
    </div>
    
    
    <script>
		var app = new Vue({
			el: '#root',
			data: {
				activities: [
					{ id: 1, user: 'Carlos Diaz', date: '22-03-2019', body: ' Legal and Scientific coments on the second sumbission sent by EC. Deadline for final feedback 09/03/2015', image: '/img/cdiaz.png' },
		            { id: 2, user: 'Sandra Pla', date: '21-03-2019', body: 'A new person joined Project Beta in NOVARTIS: Grace Smith will substitute Paul Smith. Contact details have been updated.', image: '/img/spla.png' },
                  	{ id: 3, user: 'Gilberto Goncalvez', date: '19-03-2019', body: 'D4.4 is being internally reviewed by SC members. As soon as their feedback is received, it will be submitted to the EC', image: '/img/ggoncalves.png' },
	                { id: 4, user: 'Esteban Di Falco', date: '17-03-2019', body: 'The second part of D4.4 with all the data at population level will be collected as an additional deliverable', image: '/img/edifalco.png' }
				],
				publications: [
					{ id: 1, project: 'Neuronet', title: 'Detecting cognitive changes in preclinical Alzheimer\'s disease: A review of its feasibility', year: '2019', url:'https://www.sciencedirect.com/science/article/abs/pii/S1552526016329016' },
		            { id: 2, project: 'HARMONY', title: 'Ethical challenges in preclinical Alzheimer\'s disease observational studies and trials: results of the Barcelona summit', year: '2018', url: 'https://www.ncbi.nlm.nih.gov/pubmed/26988427' },
                  	{ id: 3, project: 'ROADMAP', title: 'The European Prevention of Alzheimer\'s Dementia (EPAD) Program: An innovative approach to the development of interventions for the secondary prevention of Alzheimer\'s', year: '2018', url:'https://www.ncbi.nlm.nih.gov/pubmed/26988427' },
	                { id: 4, project: 'PARADIGM', title: 'Investigating the uniformity of pediatric patient data recorded using OpenSDE.', year: '2017', url:'https://www.ncbi.nlm.nih.gov/pubmed/16400371' }
				],
			}
		})	
    </script>
    
    
    
@endsection

