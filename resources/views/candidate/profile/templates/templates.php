<script id="candidateExperienceTemplate" type="text/x-jsrender">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-experience"
  data-experience-id="{{:candidateExperienceNumber}}" data-id="{{:id}}">
    <article class="article article-style-b">
        <div class="article-details">
            <div class="article-title">
                <h4 class="text-primary">{{:title}}</h2>
                <h6 class="text-muted">{{:company}}</h3>
            </div>
            <span class="text-muted">{{:startDate}} - {{:endDate}} | {{:country}}</span>
            <p>{{:description}}</p>
            <div class="article-cta candidate-experience-edit-delete">
                <a href="javascript:void(0)" class="btn btn-warning action-btn title="Edit" edit-experience" data-id="{{:id}}"><i class="fa fa-edit p-1"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger action-btn title="Delete"
                delete-experience" data-id="{{:id}}"><i class="fa fa-trash p-1"></i></a>
            </div>
        </div>
    </article>
</div>

</script>

<script id="candidateEducationTemplate" type="text/x-jsrender">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-education" data-education-id="{{:candidateEducationNumber}}" data-id="{{:id}}">
      <article class="article article-style-b">
          <div class="article-details">
              <div class="article-title">
                  <h4 class="text-primary education-degree-level">{{:degreeLevel}}</h2>
                  <h6 class="text-muted">{{:degreeTitle}}</h4>
              </div>
              <span class="text-muted">{{:year}} | {{:country}}</span>
              <p>{{:institute}}</p>
              <div class="article-cta candidate-education-edit-delete">
                  <a href="javascript:void(0)" class="btn btn-warning action-btn edit-education" title="Edit"
                     data-id="{{:id}}"><i class="fa fa-edit p-1"></i></a>
                  <a href="javascript:void(0)" class="btn btn-danger action-btn delete-education" title="Delete"
                     data-id="{{:id}}"><i class="fa fa-trash p-1"></i></a>
              </div>
          </div>
      </article>
  </div>

</script>
<script id="CVcandidateExperienceTemplate" type="text/x-jsrender">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-experience"
  data-experience-id="{{:candidateExperienceNumber}}" data-id="{{:id}}">
      <article class="article article-style-b">
          <div class="article-details border-0">
              <div class="article-title">
                  <h4>{{:title}}</h2>
                  <h6 class="text-muted">{{:company}}</h3>
              </div>
              <span class="text-muted">{{:startDate}} - {{:endDate}} | {{:country}}</span>
              <p>{{:description}}</p>
              <div class="article-cta candidate-experience-edit-delete">
                  <a href="javascript:void(0)" class="action-btn edit-experience" title="Edit" data-id="{{:id}}"><i class="fa fa-edit p-1"></i></a>
                  <a href="javascript:void(0)" class="text-danger action-btn delete-experience" title="Delete"
                                        data-id="{{:id}}"><i class="fa fa-trash p-1"></i></a>
              </div>
          </div>
      </article>
  </div>

</script>

<script id="CVcandidateEducationTemplate" type="text/x-jsrender">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-education" data-education-id="{{:candidateEducationNumber}}" data-id="{{:id}}">
        <article class="article article-style-b">
            <div class="article-details border-0">
                <div class="article-title">
                    <h4 class="education-degree-level">{{:degreeLevel}}</h2>
                    <h6 class="text-muted">{{:degreeTitle}}</h4>
                </div>
                <span class="text-muted">{{:year}} | {{:country}}</span>
                <p>{{:institute}}</p>
                <div class="article-cta candidate-education-edit-delete">
                    <a href="javascript:void(0)" class="action-btn edit-education" title="Edit"
                       data-id="{{:id}}"><i class="fa fa-edit p-1"></i></a>
                    <a href="javascript:void(0)" class="text-danger action-btn delete-education" title="Delete"
                       data-id="{{:id}}"><i class="fa fa-trash p-1"></i></a>
                </div>
            </div>
        </article>
    </div>

</script>


