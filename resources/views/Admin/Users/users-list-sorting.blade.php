@if(count($users)>0)
                        @php
                            $i = ($users->currentpage()-1)* $users->perpage() + 1;
                        @endphp
                       @foreach($users as $user)
                       <tr>
                          <td class="text-center" style="max-width: 10px;">
                            <div class="custom-control custom-checkbox">
                              <input value="{{$user->email}}" class="custom-control-input default_check_user" id="customCheck{{$user->id}}" data-user_id="{{$user->id}}" name="default" type="checkbox">
                              <label class="custom-control-label" for="customCheck{{$user->id}}"></label>
                            </div>
                          </td>
                          <td class="text-center" style="max-width: 10px;">
                            {{$i++}}
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->firstname}} {{$user->lastname}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->nickname}}</span>
                            </div>
                          </td>
                          <td>
                            @if($user->plansCount == 0 && $user->devicesCount == 0)
                              None
                            @elseif($user->plansCount != 0 && $user->devicesCount != 0)
                              Plan & Device
                            @elseif($user->plansCount != 0 && $user->devicesCount == 0)
                              Plan
                            @elseif($user->plansCount == 0 && $user->devicesCount != 0)
                              Device
                            @endif
                          </td>
                          <td>
                            <span class="badge badge-dot mr-4">
                              @if($user->is_active == 0)
                                <span class="not_ap_ms"><i class="bg-danger"></i>Pending verification</span>
                              @else
                                @if($user->unApprovedCount!=0)
                                  <span class="not_ap_ms"><i class="bg-danger"></i>Pending Product approval</span>
                                @else
                                  <span class="approved_ms"><i class="bg-success"></i> Active</span>
                                @endif
                              @endif
                            </span>
                          </td>
                          <td>{{$user->plansCount}}</td>
                          <td>{{$user->devicesCount}}</td>
                          <td>{{ date("m/d/Y", strtotime($user->created_at)) }}</td>
                          <td>{{ date("m/d/Y", strtotime($user->updated_at)) }}</td>
                          <td>
                            <a class="btn btn-icon btn-2 btn-success btn-sm forgot_email" href="javascript:void(0);" data-url="{{url('/admin/forgotEmail')}}/{{base64_encode($user->id)}}" data-toggle="tooltip" data-placement="top" title="Send forgot password email">
                              <span class="btn-inner--icon"><i class="ni ni-email-83"></i></span>
                            </a>
                            <a class="btn btn-icon btn-2 btn-primary btn-sm" href="{{url('/admin/userDetail')}}/{{base64_encode($user->id)}}" data-toggle="tooltip" data-placement="top" title="View">
                              <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                            </a>
                          </td>
                           
                       </tr>
                       @endforeach
                     @else
                       <tr>
                         <th colspan="8">
                           <div class="media-body text-center">
                               <span class="mb-0 text-sm">No data found.</span>
                           </div>
                         </th>
                       </tr>
                     @endif