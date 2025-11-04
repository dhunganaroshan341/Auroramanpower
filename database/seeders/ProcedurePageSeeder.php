<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcedurePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'title' => 'Required Documents',
                'slug' => 'required_documents',
                'content' => ' <!-- Content Side -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="sec-title mb_70">
                            <span class="sub-title mb_10">Required Documents</span>
                            <h2>Essential Documents for Recruitment of Nepali Nationals</h2>
                            <p class="mt_20">In accordance with the regulations set by the Ministry of Labor & Transport,
                                Government of Nepal, the following documents are required from foreign employers or their
                                representatives to enable Aurora HR PVT. LTD. to process government formalities for the
                                recruitment of Nepali nationals. All documents should be attested by the Nepalese Consulate,
                                Notary Public, or the Chamber of Commerce of the host country.</p>
                        </div>
                        z
                        <div class="text-box mb_50">
                            <h4>For Malaysia:</h4>
                            <ol class="mb_30">
                                <li>KDN Approval (from Labor Ministry)</li>
                                <li>Translation Letter (from Labor Ministry or Home Ministry)</li>
                                <li>Demand Letter</li>
                                <li>Power of Attorney</li>
                                <li>Agency Agreement</li>
                                <li>Employment Contract</li>
                                <li>Notary Public attestation</li>
                                <li>Letter from Nepal Embassy to Labor Department, Nepal</li>
                                <li>ID copy of the authorized person of the employer company</li>
                                <li>Letter from the employer company to Malaysian Consulate in Nepal</li>
                            </ol>

                            <h4>For Japan, Qatar, Kuwait, Bahrain, Oman, and UAE:</h4>
                            <ol>
                                <li>Demand Letter</li>
                                <li>Power of Attorney</li>
                                <li>Agency Agreement</li>
                                <li>Employment Contract</li>
                                <li>Guarantee Letter</li>
                            </ol>
                        </div>

                        <div class="text-box">
                            <p>Ensuring all required documents are properly attested and submitted in accordance with the
                                host country’s regulations helps facilitate a smooth and legally compliant recruitment
                                process.</p>
                        </div>
                    </div>
                </div>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Recruitment Process',
                'slug' => 'recruitment_process',
                'content' => ' <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="sec-title mb_70">
                            <span class="sub-title mb_10">Recruitment Process</span>
                            <h2>Comprehensive Procedure for Recruiting Nepali Nationals</h2>
                            <p class="mt_20">Aurora Human Resource Pvt. Ltd. follows a structured recruitment process to
                                ensure that only qualified and suitable candidates are selected for employment abroad. Our
                                process is designed to be transparent, efficient, and compliant with the regulations of the
                                Government of Nepal.</p>
                        </div>

                        <div class="text-box mb_50">
                            <h4>1. Pre-Labor Approval</h4>
                            <p>After receiving the Demand Letter from the employer, the documents are submitted to the
                                Department of Labor in Nepal for approval. The labor department reviews the documents and
                                grants approval for further processing.</p>

                            <h4>2. Advertisement</h4>
                            <p>Once the labor approval is obtained, the demand letter is published in national newspapers to
                                invite applications. Aurora HR Pvt. Ltd. also uses various tools such as the internet, SMS,
                                and telephone to inform potential candidates. Documents are collected either directly from
                                candidates or through sub-agents and marketing executives.</p>

                            <h4>3. Candidate Screening & Interview</h4>
                            <p>All required documents, such as passport copies, photographs, medical reports, and experience
                                certificates, are sent to the employer for initial screening. We maintain a detailed
                                database of potential candidates, including their skills, education, technical expertise,
                                and work experience. Shortlisted candidates are selected based on merit for pre-interview
                                assessments. The final interview is conducted by the employer to make the ultimate
                                selection.</p>

                            <h4>4. Communications</h4>
                            <p>Aurora HR operates with a fully computerized and networked system, ensuring timely and
                                efficient communication with both clients and candidates. Our dedicated staff provides
                                prompt assistance and ensures a smooth recruitment process.</p>

                            <h4>5. Medical Checkup</h4>
                            <p>Selected candidates undergo a full medical examination at government-authorized medical
                                centers in Nepal. Only those who are physically and mentally fit are eligible to sign the
                                employment contract and proceed to visa processing.</p>

                            <h4>6. Visa Processing</h4>
                            <p>All necessary documents, including passport copies, photographs, medical reports, and
                                experience certificates, are forwarded to the employer to complete the visa processing. This
                                step ensures that the candidate meets all requirements for employment abroad.</p>
                        </div>

                        <div class="text-box">
                            <p>Through this structured recruitment process, Aurora HR Pvt. Ltd. ensures the highest
                                standards of professionalism, compliance, and quality in placing Nepali nationals with
                                reputable foreign employers.</p>
                        </div>
                    </div>
                </div>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
