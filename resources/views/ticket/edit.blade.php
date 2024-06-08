<!-- Modal -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js"></script>
<div class="modal fade" id="editTicketModal" tabindex="-1" role="dialog" aria-labelledby="editTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTicketModalLabel">Edit Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form action="{{ route('edit.ticket', $ticket->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Ticket Details -->
                    <h5 class="mt-3">Ticket Details</h5>
                    <div class="form-group">
                        <label for="requested_by">Requested by</label>
                        <input type="text" class="form-control" id="requested_by" value="{{ $ticket->user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="service_location">Location Service</label>
                        <input type="text" class="form-control" id="service_location" name="service_location" value="{{ $ticket->service_location }}">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select id="unit" class="form-control" name="unit">
                            <option value="MICT" {{ $ticket->unit == 'MICT' ? 'selected' : '' }}>MICT</option>
                            <option value="MIS" {{ $ticket->unit == 'MIS' ? 'selected' : '' }}>MIS</option>
                            <option value="Repair" {{ $ticket->unit == 'Repair' ? 'selected' : '' }}>Repair</option>
                            <option value="Network" {{ $ticket->unit == 'Network' ? 'selected' : '' }}>Network</option>
                        </select>
                    </div>
                        @php
                            if (!is_null($ticket['ictram_id'])) {
                                $type = "ICTRAM";
                            } elseif (!is_null($ticket['nicmu_id'])) {
                                $type = "NICMU";
                            } elseif (!is_null($ticket['mis_id'])) {
                                $type = "MIS";
                            } else {
                                $type = null;
                            }


                        @endphp
                        @if(!is_null($ticket['ictram_id'])) 
                            <div class="form-group" id="app" data-type="{{$type}}" job_type_data-type_ictram="{{$ticket->ictram->jobType->id}}" equipment_data-type_ictram="{{$ticket->ictram->equipment->id}}" problem_data-type_ictram="{{$ticket->ictram->problem->id}}>
                                <label for="request">Request</label>
                                <select class="form-control" id="request" v-model="selectedUnit" @change="fetchJobTypeDetails">
                                    @if(!is_null($type))
                                        <option value="{{$type}}">{{$type}}</option>
                                    @endif
                                <option value="ICTRAM" @if($type == "ICTRAM") style="display:none" @endif>ICTRAM</option>
                                <option value="NICMUS" @if($type == "NICMUS") style="display:none" @endif>NICMUS</option>
                                <option value="MIS" @if($type == "MIS") style="display:none" @endif>MIS</option>
                                </select>
                                <div v-if="equipmentDetailsICTRAM.length > 0">
                                <div class="form-group">
                                    <label for="job_type">Select Job Type Details:</label>
                                    <select class="form-control" name="ictram_id" v-model="selectedJobTypeICTRAM" @change="fetchEquipmentDetailsICTRAM(selectedJobTypeICTRAM)">
                                        <option value="" disabled>Select Job Type</option>
                                        <option v-for="detail in uniqueJobTypeDetailsICTRAM" :key="detail.job_type.id" :value="detail.job_type.id">
                                            ID: @{{ detail.job_type.id }} - @{{ detail.job_type.jobType_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="equipment">Select Equipment Details:</label>
                                    <select class="form-control" name="ictram_equipment_id" v-model="selectedEquipmentICTRAM" @change="fetchProblemDetailsICTRAM(selectedEquipmentICTRAM)">
                                        <option value="" disabled>Select Equipment</option>
                                        <option v-for="detail in uniqueEquipmentDetailsICTRAM" :key="detail.equipment.id" :value="detail.equipment.id">
                                            ID: @{{ detail.equipment.id }} - @{{ detail.equipment.equipment_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="problem">Select Problem Details:</label>
                                    <select class="form-control" name="ictram_problem_id" v-model="selectedProblemICTRAM">
                                        <option value="" disabled>Select Problem</option>
                                        <option v-for="detail in uniqueProblemDetailsICTRAM" :key="detail.problem.id" :value="detail.problem.id">
                                        ID: @{{ detail.problem.id }} - @{{ detail.problem.problem_description }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <!-- NICMUS Details -->
                            @if(!is_null($ticket['nicmu_id']))
                            <div class="form-group" v-if="equipmentDetailsNICMU.length > 0">
                                <div class="form-group">
                                    <label for="job_type">Select Job Type Details:</label>
                                    <select class="form-control" name="nicmu_id" v-model="selectedJobTypeNICMU" @change="fetchEquipmentDetails(selectedJobTypeNICMU)">
                                        <option value="" disabled>Select Job Type</option>
                                        <option v-for="detail in uniqueJobTypeDetailsNICMU" :key="detail.job_type.id" :value="detail.job_type.id">
                                            ID: @{{ detail.job_type.id }} - @{{ detail.job_type.jobType_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="equipment">Select Equipment Details:</label>
                                    <select class="form-control" name="nicmu_equipment_id" v-model="selectedEquipmentNICMU" @change="fetchProblemDetails(selectedEquipmentNICMU)">
                                        <option value="" disabled>Select Equipment</option>
                                        <option v-for="detail in uniqueEquipmentDetailsNICMU" :key="detail.equipment.id" :value="detail.equipment.id">
                                        ID: @{{ detail.equipment.id }} - @{{ detail.equipment.equipment_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="problem">Select Problem Details:</label>
                                    <select class="form-control" name="nicmu_problem_id" v-model="selectedProblemNICMU">
                                        <option value="" disabled>Select Problem</option>
                                        <option v-for="detail in uniqueProblemDetailsNICMU" :key="detail.problem.id" :value="detail.problem.id">
                                        ID: @{{ detail.problem.id }} - @{{ detail.problem.problem_description }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <!-- MIS Details -->
                            @if(!is_null($ticket['mis_id']))
                            <div class="form-group" v-if="equipmentDetailsMIS.length > 0">
                                <label for="request_type_name">Request Type Name:</label>
                                <select class="form-control" name="mis_id" v-model="selectedRequestType" @change="fetchRequestTypeDetailsMIS(selectedRequestType)">
                                    <option value="" disabled>Select Request Type</option>
                                    <option v-for="detail in uniqueRequestTypeMIS" :key="detail.request_type_name.id" :value="detail.request_type_name.id">
                                    ID: @{{ detail.request_type_name.id }} - @{{ detail.request_type_name.requestType_name }}
                                    </option>
                                </select>
                                <label for="job_type">Select Job Type:</label>
                                <select class="form-control" name="mis_job_type_id" v-model="selectedJobTypeMIS" @change="fetchAccountNameMIS(selectedJobTypeMIS)">
                                    <option value="" disabled>Select Job Type</option>
                                    <option v-for="detail in uniqueJobTypeDetailsMIS" :key="detail.job_type.id" :value="detail.job_type.id">
                                    ID: @{{ detail.job_type.id }} - @{{ detail.job_type.jobType_name }}
                                    </option>
                                </select>
                                <label for="account_name">Select Account Name:</label>
                                <select class="form-control" name="mis_asname_id" v-model="selectedAccountname">
                                    <option value="" disabled>Select Account Name</option>
                                    <option v-for="detail in accountNameMISes" :key="detail.as_name.id" :value="detail.as_name.id">
                                    ID: @{{ detail.as_name.id }} - @{{ detail.as_name.name }}
                                    </option>
                                </select>
                            </div>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="priority_level">Priority</label>
                        <select id="priority_level" class="form-control" name="priority_level">
                            <option value="High" {{ $ticket->priority_level == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Mid" {{ $ticket->priority_level == 'Mid' ? 'selected' : '' }}>Mid</option>
                            <option value="Low" {{ $ticket->priority_level == 'Low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" name="status">
                            <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <!-- Assign To -->
                    <h5 class="mt-3">Assign To</h5>
                    <div class="form-group" >
                        <label for="assigned_to">Assign to<span class="required">*</span></label>
                        <select class="selectpicker form-control" id="assigned_to" name="assigned_to[]" data-live-search="true" multiple>
                            @foreach($userIds as $user)
                                <option value="{{ $user->id }}" data-content="
                                    <span class='text-black'><strong>{{ $user->name }}</strong><br>
                                    <small>Expertise: {{ implode(', ', $user->expertise ?? ['No Expertise']) }}</small><br>
                                    <small>Assigned to Tickets: {{ $user->tickets->count() }}</small></span>">
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Assessment and Action -->
                    <h5 class="mt-3">Assessment and Action</h5>
                    <div class="form-group">
                        <label>Initial Assessment</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="on_site" name="initial_assessment" value="On-Site" {{ $ticket->initial_assessment == 'On-Site' ? 'checked' : '' }}>
                            <label class="form-check-label" for="on_site">On-Site</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="shipped_at_office" name="initial_assessment" value="Shipped at Office" {{ $ticket->initial_assessment == 'Shipped at Office' ? 'checked' : '' }}>
                            <label class="form-check-label" for="shipped_at_office">Shipped at Office</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="action_performed">Action Taken</label>
                        <textarea class="form-control" id="action_performed" name="action_performed">{{ $ticket->action_performed }}</textarea>
                    </div>

                    <!-- Upload File -->
                    <div class="form-group">
                        <label for="file_path">Upload File</label>
                        <input type="file" class="form-control" id="file_path" name="file_path">
                    </div>

                    <!-- Form Actions -->
                    <div class="form-group">
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                
                <!-- Additional Information -->
                <div class="mt-4">
                    <p><strong>Assigned To:</strong> {{ $ticket->assignedUser ? $ticket->assignedUser->name : 'Unassigned' }}</p>
                    <p><strong>Escalation Reason:</strong> {{ $ticket->escalation_reason_for_workload_limit_reached ?? 'None' }}</p>
                </div>
                
                <!-- Escalation Forms -->
                @if ($ticket->assigned_user_id == auth()->id() || auth()->user()->role == 1)
                    <hr>
                    <h4>Reached the Limit of Workload?</h4>
                    <form action="{{ route('tickets.unassign', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reason">Escalation Reason:</label>
                            <input type="text" name="reason" id="reason" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-danger">Unassign Myself</button>
                    </form>
                @endif
                <hr>
                <h4>Escalation Reason Due to Client Noncompliance</h4>
                <form action="{{ route('nonComplianceEscalation', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="escalationReasonDue_to_clientNoncompliance">Escalation Reason Due to Client Noncompliance:</label>
                        <input type="text" id="escalationReasonDue_to_clientNoncompliance" name="escalationReasonDue_to_clientNoncompliance" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="clientNoncomplianceFile">Client Noncompliance File:</label>
                        <input type="file" id="clientNoncomplianceFile" name="clientNoncomplianceFile" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
const { createApp, ref, computed } = Vue;

createApp({
    setup() {
        const selectedUnit = ref(document.getElementById('app').getAttribute('data-type'));
        
        const selectedICTRAMDetail = ref('');
        const selectedEquipmentDetail = ref('');
        const accountNameDetails = ref([]);
        const equipmentDetailsNICMU = ref([]);
        const equipmentDetailsICTRAM = ref([]);
        const equipmentDetailsMIS = ref([]);
        const problemDetails = ref([]);
        const problemDetailsICTRAM = ref([]);
        const selectedProblemNICMU = ref('');
        const selectedJobTypeNICMU = ref('');
        const selectedEquipmentNICMU = ref('');
        const selectedJobTypeICTRAM = ref(document.getElementById('app').getAttribute('job_type_data-type_ictram'));
        const selectedEquipmentICTRAM = ref(document.getElementById('app').getAttribute('equipment_data-type_ictram'));
        const selectedProblemICTRAM = ref(document.getElementById('app').getAttribute('problem_data-type_ictram'));
        const selectedRequestType = ref('');
        const selectedJobTypeMIS = ref('');
        const selectedAccountname = ref('');
        const ICTRAM = ref([]);
        const NICMU = ref([]);
        const MIS = ref([]);
        const accountNameMISes = ref([]);
        console.log(selectedEquipmentICTRAM, "testing");
        const uniqueJobTypeDetailsNICMU = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            equipmentDetailsNICMU.value.forEach(detail => {
                if (!seenIds.has(detail.job_type.id)) {
                    seenIds.add(detail.job_type.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueJobTypeDetailsICTRAM = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            equipmentDetailsICTRAM.value.forEach(detail => {
                if (!seenIds.has(detail.job_type.id)) {
                    seenIds.add(detail.job_type.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueEquipmentDetailsICTRAM = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            ICTRAM.value.forEach(detail => {
                if (!seenIds.has(detail.equipment.id)) {
                    seenIds.add(detail.equipment.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueJobTypeDetailsMIS = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            MIS.value.forEach(detail => {
                if (!seenIds.has(detail.job_type.id)) {
                    seenIds.add(detail.job_type.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueEquipmentDetailsNICMU = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            NICMU.value.forEach(detail => {
                if (!seenIds.has(detail.equipment.id)) {
                    seenIds.add(detail.equipment.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueProblemDetailsNICMU = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            problemDetails.value.forEach(detail => {
                if (!seenIds.has(detail.problem.id)) {
                    seenIds.add(detail.problem.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueProblemDetailsICTRAM = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            problemDetailsICTRAM.value.forEach(detail => {
                if (!seenIds.has(detail.problem.id)) {
                    seenIds.add(detail.problem.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueRequestTypeMIS = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            equipmentDetailsMIS.value.forEach(detail => {
                if (!seenIds.has(detail.mis_request_type_id)) {
                    seenIds.add(detail.mis_request_type_id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const uniqueAccountNameMIS = computed(() => {
            const uniqueDetails = [];
            const seenIds = new Set();
            accountNameMISes.value.forEach(detail => {
                if (!seenIds.has(detail.as_name.id)) {
                    seenIds.add(detail.as_name.id);
                    uniqueDetails.push(detail);
                }
            });
            return uniqueDetails;
        });

        const fetchJobTypeDetails = async () => {
            try {
                const response = await axios.get('/get-job-type-details', {
                    params: { unit: selectedUnit.value }
                });
                if (response.data.ictram) {
                    equipmentDetailsICTRAM.value = response.data.ictram;
                    equipmentDetailsNICMU.value = [];
                    equipmentDetailsMIS.value = [];
                } else if (response.data.nicmu) {
                    equipmentDetailsNICMU.value = response.data.nicmu;
                    equipmentDetailsICTRAM.value = [];
                    equipmentDetailsMIS.value = [];
                } else if (response.data.mis) {
                    equipmentDetailsMIS.value = response.data.mis;
                    equipmentDetailsICTRAM.value = [];
                    equipmentDetailsNICMU.value = [];
                }
            } catch (error) {
                console.error('Error fetching job type details:', error);
            }
        };

        const fetchEquipmentDetails = (id) => {
            NICMU.value = equipmentDetailsNICMU.value.filter(detail => detail.nicmu_job_type_id === id);
        };

        const fetchEquipmentDetailsICTRAM = (id) => {
            ICTRAM.value = equipmentDetailsICTRAM.value.filter(detail => detail.ictram_job_type_id === id);
        };

        const fetchRequestTypeDetailsMIS = (id) => {
            MIS.value = equipmentDetailsMIS.value.filter(detail => detail.mis_request_type_id === id);
        };

        const fetchProblemDetailsICTRAM = (id) => {
            problemDetailsICTRAM.value = ICTRAM.value.filter(detail => detail.ictram_equipment_id === id);
        };

        const fetchAccountNameMIS = (id) => {
            accountNameMISes.value = MIS.value.filter(detail => detail.mis_job_type_id === id);
        };

        const fetchProblemDetails = (id) => {
            problemDetails.value = NICMU.value.filter(detail => detail.nicmu_equipment_id === id);
        };

        return {
            selectedUnit,
            selectedICTRAMDetail,
            selectedEquipmentDetail,
            accountNameDetails,
            equipmentDetailsNICMU,
            equipmentDetailsICTRAM,
            equipmentDetailsMIS,
            problemDetails,
            problemDetailsICTRAM,
            selectedProblemNICMU,
            selectedJobTypeNICMU,
            selectedEquipmentNICMU,
            selectedJobTypeICTRAM,
            selectedEquipmentICTRAM,
            selectedProblemICTRAM,
            selectedRequestType,
            selectedJobTypeMIS,
            selectedAccountname,
            ICTRAM,
            NICMU,
            MIS,
            accountNameMISes,
            uniqueJobTypeDetailsNICMU,
            uniqueEquipmentDetailsNICMU,
            uniqueProblemDetailsNICMU,
            uniqueJobTypeDetailsICTRAM,
            uniqueEquipmentDetailsICTRAM,
            uniqueProblemDetailsICTRAM,
            uniqueJobTypeDetailsMIS,
            uniqueRequestTypeMIS,
            uniqueAccountNameMIS,
            fetchJobTypeDetails,
            fetchEquipmentDetails,
            fetchEquipmentDetailsICTRAM,
            fetchProblemDetailsICTRAM,
            fetchRequestTypeDetailsMIS,
            fetchAccountNameMIS,
            fetchProblemDetails,
        };
    },
    mounted() {
        this.fetchJobTypeDetails();
    }
}).mount('#app');
</script>